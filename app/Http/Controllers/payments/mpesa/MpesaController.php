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
use App\Models\Category;
use App\Models\B2BPaymentBenOlives;
use Illuminate\Http\Request;
use App\Events\PurchaseSuccessfull;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\KasperskyBenOlivesApiService;

class MpesaController extends Controller
{
    private $checkoutData;
    protected $kasperskyApiService;

    public function __construct(KasperskyBenOlivesApiService $kasperskyApiService)
    {
        $this->kasperskyApiService = $kasperskyApiService;
    }

    //Getting access token for C2B MPESA EXPRESS
    public function getAccessToken()
    {
        Log::info('RETRIEVING ACCESS TOKEN FOR MPESA API......');   
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);
    
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
            ])->get('https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    
            $responseData = $response->json();
    
            // Check if the access token is present
            if (isset($responseData['access_token'])) {
                // Log the access token before returning it
                Log::info('Access token retrieved: ' . $responseData['access_token']);
                return $responseData['access_token'];
            } else {
                // Log an error if the access token is not in the response
                Log::error('Failed to retrieve access token: ' . json_encode($responseData));
                return null;
            }
        } catch (\Exception $e) {
            // Log any exception that occurs during the API call
            Log::error('Error retrieving access token: ' . $e->getMessage());
            return null;
        }
    }    

    //Initiate an STK PUSH METHOS
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
        // fetch the product from db
        try {
            $product = Product::with('category')->where('product_api_id', $productApiId)->firstOrFail();
            $productId = $product->id;
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
                    $client->product_id = $product->id;
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
                    $this->sendPurchaseEmail($fullname, $email, $productId, $response->json());

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

    // This is the method that will be executed once the mpesa callsback after user has paid successfully.
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

                // B2B BenOlives starts here
                $this->initiateClientSubscriptionToBenOlives($order, $client->subscriberId);

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

    // This is the method that will be used to check the state of the payment C2B
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

    
    // Initiate subscription for B2B
    public function initiateClientSubscriptionToBenOlives($order, $SubscriberId)
    {
        //retrieve the product that client is buying based on order
        $product = Product::find($order->product_id);
        if ($product) {
            // Retrieve the category and check if it's 'kaspersky'
            $category = Category::find($product->category_id);

            if ($category && $category->slug === 'kaspersky') {
                // Create subscription and log the response
                $subscriptionResponse = $this->kasperskyApiService->createSubscription($product->product_api_id, $SubscriberId);

                if (isset($subscriptionResponse['transactionReference'])) {
                    $transactionReference = $subscriptionResponse['transactionReference'];
                } else {
                    // Handle the case where transactionReference is missing
                    Log::error('Transaction reference is missing in the response.', ['response' => $subscriptionResponse]);
                }

                // Initiate the B2B transaction with the transaction reference
                $this->initiateB2BTransaction($transactionReference);
            } else {
                Log::warning('Product does not belong to the Kaspersky category', [
                    'product_name' => $product->product_name,
                    'category_slug' => $category ? $category->slug : 'No category found',
                ]);
            }
        } else {
            Log::error('Product not found for order', ['order_id' => $order->id]);
        }
    }

    //This access token is for B2B
    public function getAccessTokenForB2B()
    {
        try {
            // Get credentials from .env
            $consumerKey = env('MPESA_B2B_CONSUMER_KEY');
            $consumerSecret = env('MPESA_B2B_CONSUMER_SECRET');

            // Generate the Authorization header
            $authorization = base64_encode("{$consumerKey}:{$consumerSecret}");

            // Define the API endpoint
            $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

            // Make the request to get the token
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $authorization,
            ])->get($url);

            // Check if the response is successful
            if ($response->successful()) {
                // Return the access token
                $responseData = $response->json();
                return $responseData['access_token'];
            }

            // Log the error response if token retrieval fails
            Log::error('Failed to retrieve access token from M-PESA', [
                'response' => $response->body(),
                'status_code' => $response->status(),
            ]);

            return null;

        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error retrieving access token for M-PESA: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return null;
        }
    }

    //generate security credential for B2B using the initiator password we set in G2 portal
    function generateSecurityCredential($initiatorPassword)
    {
        // Step 1: Embed the M-Pesa Public Certificate (X.509 certificate) directly as a string
        $certificate = "-----BEGIN CERTIFICATE-----\n"
                . "MIIGkzCCBXugAwIBAgIKXfBp5gAAAD+hNjANBgkqhkiG9w0BAQsFADBbMRMwEQYK\n"
                . "CZImiZPyLGQBGRYDbmV0MRkwFwYKCZImiZPyLGQBGRYJc2FmYXJpY29tMSkwJwYD\n"
                . "VQQDEyBTYWZhcmljb20gSW50ZXJuYWwgSXNzdWluZyBDQSAwMjAeFw0xNzA0MjUx\n"
                . "NjA3MjRaFw0xODAzMjExMzIwMTNaMIGNMQswCQYDVQQGEwJLRTEQMA4GA1UECBMH\n"
                . "TmFpcm9iaTEQMA4GA1UEBxMHTmFpcm9iaTEaMBgGA1UEChMRU2FmYXJpY29tIExp\n"
                . "bWl0ZWQxEzARBgNVBAsTClRlY2hub2xvZ3kxKTAnBgNVBAMTIGFwaWdlZS5hcGlj\n"
                . "YWxsZXIuc2FmYXJpY29tLmNvLmtlMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB\n"
                . "CgKCAQEAoknIb5Tm1hxOVdFsOejAs6veAai32Zv442BLuOGkFKUeCUM2s0K8XEsU\n"
                . "t6BP25rQGNlTCTEqfdtRrym6bt5k0fTDscf0yMCoYzaxTh1mejg8rPO6bD8MJB0c\n"
                . "FWRUeLEyWjMeEPsYVSJFv7T58IdAn7/RhkrpBl1dT7SmIZfNVkIlD35+Cxgab+u7\n"
                . "+c7dHh6mWguEEoE3NbV7Xjl60zbD/Buvmu6i9EYz+27jNVPI6pRXHvp+ajIzTSsi\n"
                . "eD8Ztz1eoC9mphErasAGpMbR1sba9bM6hjw4tyTWnJDz7RdQQmnsW1NfFdYdK0qD\n"
                . "RKUX7SG6rQkBqVhndFve4SDFRq6wvQIDAQABo4IDJDCCAyAwHQYDVR0OBBYEFG2w\n"
                . "ycrgEBPFzPUZVjh8KoJ3EpuyMB8GA1UdIwQYMBaAFOsy1E9+YJo6mCBjug1evuh5\n"
                . "TtUkMIIBOwYDVR0fBIIBMjCCAS4wggEqoIIBJqCCASKGgdZsZGFwOi8vL0NOPVNh\n"
                . "ZmFyaWNvbSUyMEludGVybmFsJTIwSXNzdWluZyUyMENBJTIwMDIsQ049U1ZEVDNJ\n"
                . "U1NDQTAxLENOPUNEUCxDTj1QdWJsaWMlMjBLZXklMjBTZXJ2aWNlcyxDTj1TZXJ2\n"
                . "aWNlcyxDTj1Db25maWd1cmF0aW9uLERDPXNhZmFyaWNvbSxEQz1uZXQ/Y2VydGlm\n"
                . "aWNhdGVSZXZvY2F0aW9uTGlzdD9iYXNlP29iamVjdENsYXNzPWNSTERpc3RyaWJ1\n"
                . "dGlvblBvaW50hkdodHRwOi8vY3JsLnNhZmFyaWNvbS5jby5rZS9TYWZhcmljb20l\n"
                . "MjBJbnRlcm5hbCUyMElzc3VpbmclMjBDQSUyMDAyLmNybDCCAQkGCCsGAQUFBwEB\n"
                . "BIH8MIH5MIHJBggrBgEFBQcwAoaBvGxkYXA6Ly8vQ049U2FmYXJpY29tJTIwSW50\n"
                . "ZXJuYWwlMjBJc3N1aW5nJTIwQ0ElMjAwMixDTj1BSUEsQ049UHVibGljJTIwS2V5\n"
                . "JTIwU2VydmljZXMsQ049U2VydmljZXMsQ049Q29uZmlndXJhdGlvbixEQz1zYWZh\n"
                . "cmljb20sREM9bmV0P2NBQ2VydGlmaWNhdGU/YmFzZT9vYmplY3RDbGFzcz1jZXJ0\n"
                . "aWZpY2F0aW9uQXV0aG9yaXR5MCsGCCsGAQUFBzABhh9odHRwOi8vY3JsLnNhZmFy\n"
                . "aWNvbS5jby5rZS9vY3NwMAsGA1UdDwQEAwIFoDA9BgkrBgEEAYI3FQcEMDAuBiYr\n"
                . "BgEEAYI3FQiHz4xWhMLEA4XphTaE3tENhqCICGeGwcdsg7m5awIBZAIBDDAdBgNV\n"
                . "HSUEFjAUBggrBgEFBQcDAgYIKwYBBQUHAwEwJwYJKwYBBAGCNxUKBBowGDAKBggr\n"
                . "BgEFBQcDAjAKBggrBgEFBQcDATANBgkqhkiG9w0BAQsFAAOCAQEAC/hWx7KTwSYr\n"
                . "x2SOyyHNLTRmCnCJmqxA/Q+IzpW1mGtw4Sb/8jdsoWrDiYLxoKGkgkvmQmB2J3zU\n"
                . "ngzJIM2EeU921vbjLqX9sLWStZbNC2Udk5HEecdpe1AN/ltIoE09ntglUNINyCmf\n"
                . "zChs2maF0Rd/y5hGnMM9bX9ub0sqrkzL3ihfmv4vkXNxYR8k246ZZ8tjQEVsKehE\n"
                . "dqAmj8WYkYdWIHQlkKFP9ba0RJv7aBKb8/KP+qZ5hJip0I5Ey6JJ3wlEWRWUYUKh\n"
                . "gYoPHrJ92ToadnFCCpOlLKWc0xVxANofy6fqreOVboPO0qTAYpoXakmgeRNLUiar\n"
                . "0ah6M/q/KA==\n"
                . "-----END CERTIFICATE-----";

        // Step 2: Convert the initiator password into a byte array (UTF-8 encoding)
        $passwordBytes = utf8_encode($initiatorPassword);

        // Step 3: Extract the public key from the certificate
        $certResource = openssl_x509_read($certificate);
        if (!$certResource) {
            throw new Exception('Unable to read certificate.');
        }

        $publicKey = openssl_pkey_get_public($certResource);
        if (!$publicKey) {
            throw new Exception('Unable to extract public key from certificate.');
        }

        // Step 4: Encrypt the password using RSA with PKCS#1.5 padding
        $encryptedPassword = '';
        $result = openssl_public_encrypt($passwordBytes, $encryptedPassword, $publicKey, OPENSSL_PKCS1_PADDING);

        if (!$result) {
            throw new Exception('Encryption failed: ' . openssl_error_string());
        }

        // Step 5: Encode the encrypted password in Base64
        $securityCredential = base64_encode($encryptedPassword);

        return $securityCredential;
    }
    
    // Method to initiate B2B transaction
    public function initiateB2BTransaction($transactionReference)
    {
        // Log the productApiId before attempting to fetch the product
        Log::info('Initiating B2B Payment to Ben Olives using M-Pesa API..');

        //Firstly we have to authenticate with MPESA API endpoint to get Access token
        try {
            $accessToken = $this->getAccessTokenForB2B();
            if (!$accessToken) {
                Log::error('Failed to retrieve access token from M-PESA');
                return;
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving access token for B2B TO BENOLIVES: ' . $e->getMessage());
        }

        //SET up the necessary parameters to initiate the B2B PAYBILL MPESA API
        $url =  "https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest";
        $Initiator = env('MPESA_B2B_INITIATOR');
        // I have directly passed in the password maybe I could pass an env later
        $SecurityCredential = $this->generateSecurityCredential('Xn2WNhAxAZVa!bs');
        $CommandID = 'BusinessPayBill';
        $SenderIdentifierType = '4';
        $RecieverIdentifierType = '4';
        $Amount = 1; //the amount we will get it from the request
        $PartyA = env('MPESA_B2B_PARTY_A');
        $PartyB = env('MPESA_B2B_PARTY_B');
        $AccountReference = $transactionReference;
        $Requester = env('MPESA_B2B_REQUESTER');
        $Remarks = env('MPESA_B2B_REMARKS');
        $QueueTimeOutURL = env('MPESA_B2B_QUEUE_TIMEOUT_URL');
        $ResultURL = env('MPESA_B2B_RESULT_CALLBACK_URL');

        $data = [
            "Initiator" => $Initiator,
            "SecurityCredential" => $SecurityCredential,
            "CommandID" => $CommandID,
            "SenderIdentifierType" => $SenderIdentifierType,
            "RecieverIdentifierType" => $RecieverIdentifierType,
            "Amount" => $Amount,
            "PartyA" => $PartyA,
            "PartyB" => $PartyB,
            "AccountReference" => $AccountReference,
            "Requester" => $Requester,
            "Remarks" => $Remarks,
            "QueueTimeOutURL" =>  $QueueTimeOutURL,
            "ResultURL" => $ResultURL,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post($url, $data);

            if ($response->successful()) {
                $res = $response->json();
                //debugging
                Log::info('B2B BUSINESS PAYBILL RESPONSE CONFIRMATION....: ' . json_encode($res));

                if (isset($res['ResponseCode']) && $res['ResponseCode'] == '0') {
                    $OriginatorConversationID = $res['OriginatorConversationID'] ?? 'N/A';
                    $ConversationID = $res['ConversationID'] ?? 'N/A';
                    $ResponseDescription = $res['ResponseDescription'] ?? 'N/A';

                    //create an initial b2b_payments_benolives record to show payment request.
                    try {
                        $b2bPaymentBenolives = new B2BPaymentBenOlives();
                        $b2bPaymentBenolives->originator_conversation_id = $OriginatorConversationID;
                        $b2bPaymentBenolives->conversation_id = $ConversationID;
                        $b2bPaymentBenolives->result_desc = $ResponseDescription;
                        if (!$b2bPaymentBenolives->save()) {
                            Log::error('Failed to save B2BPaymentBenOlives: ' . json_encode($b2bPaymentBenolives->errors()));
                        } else {
                            Log::info('Successfully saved B2BPaymentBenOlives record.');
                        }
                    } catch (\Exception $e) {
                        Log::error('ERROR DURING CREATING PAYMENT BENOLIVES DATA FOR INITIAL REQUEST: ' . $e->getMessage());
                    }

                }
            } else {
                Log::error('B2B BUSINESS PAYBILL API error: ' . $response->body());
                return response()->json(['error' => 'Failed to initiate B2B PAYBILL API'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error during M-Pesa API call: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initiate B2B PAYBILL API'], 500);
        }
    }

    //the callback function that will handle result url
    public function b2BCallback(Request $request)
    {
        try {
            // Log the request for debugging (optional)
            $response_result = json_encode($request->all());
            Log::info('B2B Callback received: ' . $response_result);

            // Decode the JSON string into an associative array
            $response_array = json_decode($response_result, true);

            if (isset($response_array['Result'])) {
                $response = $response_array['Result'];
            } else {
                Log::error("No 'Result' key found in the response.");
                return; // early return in case of no result
            }

            // Get basic response details as strings
            $resultCode = (string) ($response['ResultCode'] ?? ''); // Ensure it's a string
            $resultDesc = (string) ($response['ResultDesc'] ?? ''); // Ensure it's a string

            // If ResultCode is 0, payment was successful
            if ($resultCode == '0') {
                // Extract necessary fields (all treated as strings)
                $originatorConversationId = (string) ($response['OriginatorConversationID'] ?? '');
                $conversationId = (string) ($response['ConversationID'] ?? '');
                $transactionId = (string) ($response['TransactionID'] ?? '');

                // Process ResultParameters
                $resultParams = collect($response['ResultParameters']['ResultParameter']);
                $amount = (string) ($resultParams->firstWhere('Key', 'Amount')['Value'] ?? ''); // Treat as string
                $currency = (string) ($resultParams->firstWhere('Key', 'Currency')['Value'] ?? '');
                $receiverPartyPublicName = (string) ($resultParams->firstWhere('Key', 'ReceiverPartyPublicName')['Value'] ?? '');
                $debitPartyCharges = (string) ($resultParams->firstWhere('Key', 'DebitPartyCharges')['Value'] ?? '0');
                // Process DebitPartyAffectedAccountBalance as string
                $debitPartyAffectedAccountBalance = (string) ($resultParams->firstWhere('Key', 'DebitPartyAffectedAccountBalance')['Value'] ?? '');
                
                // Process Transaction Completed Time as string
                $transactionCompletedTime = (string) ($resultParams->firstWhere('Key', 'TransCompletedTime')['Value'] ?? '');
                $billReferenceNumber = (string) ($response['ReferenceData']['ReferenceItem'][0]['Value'] ?? '');

                // Log extracted values for debugging
                Log::info('Extracted Values: ', [
                    'OriginatorConversationID' => $originatorConversationId,
                    'ConversationID' => $conversationId,
                    'TransactionID' => $transactionId,
                    'Amount' => $amount,
                    'Currency' => $currency,
                    'ReceiverPartyPublicName' => $receiverPartyPublicName,
                    'DebitPartyAffectedAccountBalance' => $debitPartyAffectedAccountBalance,
                    'TransactionCompletedTime' => $transactionCompletedTime,
                    'BillReferenceNumber' => $billReferenceNumber,
                ]);

                // If you need to format transaction date, do it as a string
                // Format the transaction date as a string (if applicable)
                $formattedTransactionDate = (string) Carbon::createFromFormat('YmdHis', (string)$transactionCompletedTime)->toDateTimeString();

                // Check if we have a record with the current conversation ID
                $payment = B2BPaymentBenOlives::where('originator_conversation_id', $originatorConversationId)->first();

                if ($payment) {
                    // Update the payment record with the successful payment data
                    $payment->update([
                        'transaction_id' => $transactionId,
                        'conversation_id' => $conversationId,
                        'amount' => $amount,
                        'currency_code' => $currency,
                        'beneficiary_name' => $receiverPartyPublicName,
                        'transaction_status' => 'success',
                        'result_desc' => $resultDesc,
                        'transaction_completed_time' => $formattedTransactionDate,
                        'transaction_reference_number' => $billReferenceNumber,
                        'account_balance' => $debitPartyAffectedAccountBalance,
                        'charges' => $debitPartyCharges,
                    ]);
                    Log::info("Payment to BenOlives updated successfully: " . json_encode($payment));
                } else {
                    Log::warning("No matching payment record found for conversation ID: $originatorConversationId");
                }
            } else {
                // Payment failed, handle accordingly
                Log::error("Payment failed. ResultCode: $resultCode, ResultDesc: $resultDesc");

                // You can update the record as failed if necessary
                $payment = B2BPaymentBenOlives::where('originator_conversation_id', $response['OriginatorConversationID'])->first();
                if ($payment) {
                    $payment->update([
                        'transaction_status' => 'failed',
                        'result_desc' => $resultDesc,
                        'result_code' => $resultCode,
                    ]);
                    Log::info("Payment marked as failed: " . json_encode($payment));
                }
            }
        } catch (\Throwable $th) {
            // Catch any unexpected errors and log them
            Log::error("Error processing B2B callback: " . $th->getMessage());
        }
    } 

    public function PaymentProcessTimeOut(Request $request)
    {
        $data = $request->json()->all();
        
        // Handle timeout case
        Log::info('M-Pesa Payment Timeout:', $data);

        return response()->json(['status' => 'timeout']);
    }

    // This is the callback that Benolives will trigger when giving us the details of the product
    public function benolivesPaymentCallback(Request $request)
    {
        // Log the incoming JSON data from the callback
        Log::info('Received payment callback from Benolives:', $request->all());

    }
}