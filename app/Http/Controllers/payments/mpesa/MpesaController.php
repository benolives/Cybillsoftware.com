<?php

namespace App\Http\Controllers\payments\mpesa;

use Throwable;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Stkrequest;
use App\Models\PaymentRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductKeys;
use Illuminate\Http\Request;
use App\Events\PurchaseSuccessfull;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MpesaController extends Controller
{
    private $checkoutData;

    public function setCheckoutData(array $data)
    {
        $this->checkoutData = $data;
    }

    public function getAccessToken()
    {
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
            ])->get('https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            $responseData = $response->json();
            if (isset($responseData['access_token'])) {
                return $responseData['access_token'];
            } else {
                Log::error('Failed to retrieve access token: ' . json_encode($responseData));
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving access token: ' . $e->getMessage());
            return null;
        }
    }

    //the second argument is the route parameter
    public function initiateStkPush(Request $request, $productApiId)
    {
        // Validate the data from the incoming request.
        try {
            $request->validate([
                'email' => 'required|email',
                'phoneNumber' => 'required|regex:/^[0-9]{9}$/',
                'country' => 'required|string',
                'city' => 'required|string',
                'address' => 'required|string',
                'productPrice' => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Log the productApiId before attempting to fetch the product
        Log::info('Attempting to fetch product with product_api_id Mpesa Stk push process: ' . $productApiId);

        try {
            // Fetch the product using product_api_id
            $product = Product::with('category')->where('product_api_id', $productApiId)->firstOrFail();
            // Store the product id for further use
            $productId = $product->id;
            // If product is found, log success (optional)
            Log::info('Product fetched successfully with product_api_id Mpesa Stk push process: ' . $productApiId);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the error when the product is not found
            Log::error('Error fetching product: No query results for model [App\Models\Product] with product_api_id Mpesa Stk push process' . $productApiId);
            return response()->json(['error' => 'Product not found'], 404);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Unexpected error fetching product with product_api_id ' . $productApiId . ': ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }

        // Fetch all the data from request data
        $data = $request->all();

        // Extract specific data
        $phoneNumber = $data['phoneNumber'];
        $email = $data['email'];
        $productPrice = $data['productPrice'];
        $country = $data['country'];
        $town = $data['city'];
        $address = $data['address'];
        $fullname = $data['fullname'];

        // Combine the country code with the phone number
        $fullPhoneNumber = '254' . ltrim($phoneNumber, '0');

        // Log product price
        Log::info('Product price: ' . $productPrice);

        // Authenticate with M-Pesa endpoint
        try {
            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                return response()->json(['error' => 'Failed to retrieve access token from M-PESA'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving access token: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve access token'], 500);
        }

        // Setting up necessary parameters to initiate STK push
        // Note we are setting the stk push amount to 1 sh for testing but
        // in real instance we will set the $productPrice
        $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $PassKey = env('MPESA_PASSKEY');
        $BusinessShortCode = env('MPESA_STK_SHORTCODE');
        $Timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode($BusinessShortCode . $PassKey . $Timestamp);
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = 1;
        $PartyA = $fullPhoneNumber;
        $PartyB = env('MPESA_STK_SHORTCODE');
        $CallbackUrl = env('MPESA_CALLBACK_URL', 'https://cybillsoftware.com/stkcallback');
        $AccountReference = 'Cybill Software';
        $TransactionDesc = 'Payment for Cybill Software';

        $postData = [
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $password,
            'Timestamp' => $Timestamp,
            'TransactionType' => $TransactionType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallbackUrl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($url, $postData);

            if ($response->successful()) {
                $res = $response->json();
                Log::info('STK Push Response: ' . json_encode($res));

                if (isset($res['ResponseCode']) && $res['ResponseCode'] == '0') {
                    // Successful STK push logic
                    $MerchantRequestID = $res['MerchantRequestID'] ?? 'N/A';
                    $CheckoutRequestID = $res['CheckoutRequestID'] ?? 'N/A';
                    $CustomerMessage = 'Payment request was successful';

                    // Create a new PaymentRequest record
                    $payment = new PaymentRequest();
                    $payment->phone = $PartyA;
                    $payment->amount = $Amount;
                    $payment->reference = $AccountReference;
                    $payment->description = $TransactionDesc;
                    $payment->merchant_request_id = $MerchantRequestID;
                    $payment->checkout_request_id = $CheckoutRequestID;
                    $payment->status = 'requested';
                    $payment->save();

                    // Create a new order record
                    $order = new Order();
                    $order->product_id = $productId;
                    $order->email = $email;
                    $order->phone_number = $phoneNumber;
                    $order->amount = $Amount;
                    $order->status = 'pending_payment';
                    $order->checkout_request_id = $CheckoutRequestID;
                    $order->transaction_date = Carbon::now()->toDateTimeString();
                    $order->mpesa_receipt_number = 'N/A'; // Will be updated on callback
                    $order->save();

                    // Calculate the commission based on the actual product price
                    $commissionPercentage = $product->commission_percentage;
                    $commissionReceived = ($productPrice * $commissionPercentage) / 100;

                    // Create a new client record
                    $client = new Client();
                    // The partner is the authenticated user
                    $client->partner_id = auth()->user()->id;
                    // Partner name
                    $client->partner_name = auth()->user()->name;
                    $client->name = $fullname;
                    $client->email = $email;
                    $client->phone = $fullPhoneNumber;
                    $client->country = $country;
                    $client->town = $town;
                    $client->address = $address;
                    $client->product_name = $product->product_name;
                    // Store actual product price
                    $client->product_price = $productPrice;
                    // Set calculated commission
                    $client->commission_received = $commissionReceived;
                    $client->subscription_type = 'annually';
                    $client->expires_at = now()->addYear();
                    // Fetch the category slug using the relationship
                    $client->product_category = $product->category->slug;
                    $client->checkout_request_id = $CheckoutRequestID;
                    $client->save();

                    // Send the purchase confirmation email
                    // $this->sendPurchaseEmail($fullname, $email, $productId, $response->json());

                    Log::info('Order created with ID: ' . $order->id . ' and CheckoutRequestID: ' . $CheckoutRequestID);
                    
                    return response()->json(['message' => $CustomerMessage, 'CheckoutRequestID' => $CheckoutRequestID], 200);
                } else {
                    $CustomerMessage = $res['CustomerMessage'] ?? 'Failed to initiate STK push';
                    Log::error('STK Push Error: ' . $CustomerMessage);
                    return response()->json(['error' => $CustomerMessage], 400);
                }
            } else {
                Log::error('M-Pesa API error: ' . $response->body());
                return response()->json(['error' => 'Failed to initiate STK push'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error during M-Pesa API call: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initiate STK push'], 500);
        }
    }

    // This is the method that will be executed once the mpesa calls back
    // after user has paid successfully.
    public function stkCallback(Request $request)
    {
        Log::info('STK Callback received: ' . json_encode($request->all()));

        try {
            //retrieve stkCallback from the request of mpesa
            $stkCallback = $request->input('Body.stkCallback');
            $ResultCode = $stkCallback['ResultCode'] ?? null;

            //if ResultCode is 0 it signifies success
            if ($ResultCode == 0) {
                // Successful transaction
                $MerchantRequestID = $stkCallback['MerchantRequestID'] ?? null;
                $CheckoutRequestID = $stkCallback['CheckoutRequestID'] ?? null;
                $ResultDesc = $stkCallback['ResultDesc'] ?? null;
                $Amount = $stkCallback['CallbackMetadata']['Item'][0]['Value'] ?? null;
                $MpesaReceiptNumber = $stkCallback['CallbackMetadata']['Item'][1]['Value'] ?? null;
                $TransactionDate = $stkCallback['CallbackMetadata']['Item'][2]['Value'] ?? null;
                $PhoneNumber = $stkCallback['CallbackMetadata']['Item'][3]['Value'] ?? null;

                // Format the TransactionDate if needed
                $formattedTransactionDate = $TransactionDate ? Carbon::parse($TransactionDate)->format('Y-m-d H:i:s') : null;

                Log::info('STK callback successful transaction details: ' . json_encode([
                    'MerchantRequestID' => $MerchantRequestID,
                    'CheckoutRequestID' => $CheckoutRequestID,
                    'ResultDesc' => $ResultDesc,
                    'Amount' => $Amount,
                    'MpesaReceiptNumber' => $MpesaReceiptNumber,
                    'TransactionDate' => $TransactionDate,
                    'PhoneNumber' => $PhoneNumber,
                ]));

                /*
                check if we have a field that matches our current checkoutRequestId
                in the payment_requests table. If so then we will update that table
                to show the payment has been successfully completed
                */
                $payment = PaymentRequest::where('checkout_request_id', $CheckoutRequestID)->first();

                if ($payment) {
                    // update the payment
                    $payment->status = 'completed';
                    $payment->transaction_date = $formattedTransactionDate;
                    $payment->mpesa_receipt_number = $MpesaReceiptNumber;
                    $payment->result_desc = $ResultDesc;
                    $payment->save();

                    Log::info('PAYMENT REQUEST UPDATED SUCCESSFULLY checkOutId: ' . $CheckoutRequestID);
                } else {
                    Log::error('PaymentRequest not found for CheckoutRequestID: ' . $CheckoutRequestID);
                    return response()->json(['message' => 'Payment record not found'], 404);
                }

                $client = Client::where('checkout_request_id', $CheckoutRequestID)->first();

                if ($client) {
                    $client->status = 'complete';
                    $client->save();

                    Log::info('Client SUCCESSFULLY updated checkOutId: ' . $CheckoutRequestID);
                } else {
                    Log::error('Client was not found for CheckoutRequestID: ' . $CheckoutRequestID);
                    return response()->json(['message' => 'Client record not found'], 404);
                }

                // Update order too same as payment_requests
                $order = Order::where('checkout_request_id', $CheckoutRequestID)->first();
                if ($order) {
                    $order->status = 'completed';
                    $order->mpesa_receipt_number = $MpesaReceiptNumber;
                    $order->result_description = $ResultDesc;
                    $order->transaction_date = $formattedTransactionDate;
                    $order->save();

                    Log::info('ORDER UPDATED SUCCESSFULLY checkOutId: ' . $CheckoutRequestID);               
                    //event(new PurchaseSuccessfull($order));
                } else {
                    Log::error('Order record not found for CheckoutRequestID: ' . $CheckoutRequestID);
                }
                return response()->json(['message' => 'Purchase successful']);
            } else {
                // Transaction failed when ResultCode is not 0
                $ResultDesc = $stkCallback['ResultDesc'] ?? 'Callback failed';
                $CheckoutRequestID = $stkCallback['CheckoutRequestID'] ?? null;

                Log::info('STK CALLBACK TO COMPLETE TRANSACTION FAILED!!!!!: ' . json_encode([
                    'ResultDesc' => $ResultDesc,
                    'CheckoutRequestID' => $CheckoutRequestID,
                ]));

                // Update payment_request to indicate payment was not successfull
                $payment = PaymentRequest::where('checkout_request_id', $CheckoutRequestID)->firstOrFail();
                $payment->result_desc = $ResultDesc;
                $payment->status = 'failed';
                $payment->save();

                $order = Order::where('checkout_request_id', $CheckoutRequestID)->first();
                if ($order) {
                    $order->update([
                        'status' => 'failed',
                        'result_description' => $ResultDesc,
                    ]);
                }
                return response()->json(['message' => 'Purchase failed']);
            }
        } catch (Throwable $e) {
            Log::error('Error in STK callback: ' . $e->getMessage());
            return response()->json(['error' => 'Callback processing failed'], 500);
        }
    }

    // This is the method that will be used to check the state of the payment
    // whether it has been updated in our database or not then we will repond
    // to the request with the detials required
    public function getStatus($checkoutRequestId)
    {
        // Fetch the payment request from the database
        $payment = PaymentRequest::where('checkout_request_id', $checkoutRequestId)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment record not found'], 404);
        }

        // Return the payment status with some more data.
        return response()->json([
            'checkoutRequestId' => $checkoutRequestId,
            'status' => $payment->status,
            'transactionDate' => $payment->transaction_date,
            'mpesaReceiptNumber' => $payment->mpesa_receipt_number,
            'resultDesc' => $payment->result_desc,
        ]);
    }

    private function sendPurchaseEmail($fullname, $email, $productId, $stkPushResponse)
    {
        $product = Product::find($productId);
        if (!$product) {
            Log::error('Product not found for email sending');
            return;
        }

        $client = Client::where('email', $email)->first();
        if (!$client) {
            Log::error('client not found for email sending');
            return;
        }

        $response = is_array($stkPushResponse) ? $stkPushResponse : json_decode($stkPushResponse, true);
        $productKey = ProductKeys::where('product_id', $product->id)->first();
        $keyCode = $productKey ? $productKey->key_code : 'N/A';

        $data = [
            'customerName' => $fullname,
            'productKey' => $keyCode,
            'productName' => $product->product_name,
            'amount' => $product->price,
            'transactionDate' => Carbon::now()->toDateTimeString(),
        ];

        Log::info('Sending email with data: ' . json_encode($data));

        try {
            Mail::send('emails.purchase_confirmation', $data, function ($message) use ($email) {
                $message->to($email)
                        ->subject('Purchase Confirmation');
            });
            Log::info('Purchase confirmation email sent to ' . $email);
        } catch (Throwable $e) {
            Log::error('Error sending purchase confirmation email: ' . $e->getMessage());
        }
    }
}