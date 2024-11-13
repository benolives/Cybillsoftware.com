<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Client; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; // <-- Add this line
use App\Mail\PurchaseConfirmation;
use App\Http\Controllers\payments\mpesa\MpesaController;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $mpesaController;

    public function __construct(MpesaController $mpesaController)
    {
        $this->mpesaController = $mpesaController;
    }

    public function processCheckout(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'phoneNumber' => 'required|numeric',
            'productId' => 'required|exists:products,id',
            'productPrice' => 'required|numeric',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|unique:clients,email', // Check if email is unique in the clients table
            'client_phone' => 'required|string|max:20',
            'product_name' => 'required|string|max:255', 
            'product_price' => 'required|numeric|min:0', 
            'commission_received' => 'required|numeric|min:0', 
            'subscription_type' => 'required|in:monthly,annually'
        ]);
        
        // Get the authenticated user
         $user = Auth::user();
         
         // Calculate the commission (20% of the product price)
        $commissionRate = 0.20;
        $commission = $validatedData['productPrice'] * $commissionRate;

        
        // Save client information
        $client = Client::create([
            'partner_id' => $user->id,
            'partner_name' => $user->name,
            'name' => $validatedData['client_name'],
            'email' => $validatedData['client_email'],
            'phone' => $validatedData['client_phone'],
            'product_name' => $validatedData['product_name'],
            'product_price' => $validatedData['productPrice'],
            'commission_received' => $commission, // Save the calculated commission
            'subscription_type' => $validatedData['subscription_type'],
        ]);


        // Retrieve the product
        $product = Product::find($validatedData['productId']);
        if (!$product) {
            Log::error('Product not found with ID: ' . $validatedData['productId']);
            return view('response')->with('message', 'Product not found.');
        }

        // Pass the validated data to MpesaController for processing
        try {
            $this->mpesaController->setCheckoutData($validatedData);
            $mpesaResponse = $this->mpesaController->initiateStkPush($request);

            if ($mpesaResponse instanceof \Illuminate\Http\JsonResponse) {
                $responseData = $mpesaResponse->getData(true);

                // Log the M-Pesa response for debugging
                Log::info('M-Pesa response: ', $responseData);

                // Check if CheckoutRequestID is present in the callback
                if (isset($responseData['message']) && $responseData['message'] === 'Success. Request accepted for processing') {
                    return view('response')->with('message', 'Payment initiated. Please complete payment via M-Pesa.');
                } else {
                    Log::error('Unexpected response format from M-Pesa.', $responseData);
                    return view('response')->with('message', 'Payment initiation failed. Please try again later.');
                }
            } else {
                Log::error('Unexpected response type: ' . get_class($mpesaResponse));
                return view('response')->with('message', 'Unexpected error occurred. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
            return view('response')->with('message', 'Failed to process payment!');
        }
        
        return redirect()->back()->with('success', 'Client information saved successfully.');
    }

    protected function sendConfirmationEmail($email, $productId, $productName, $amount)
    {
        Mail::to($email)->send(new PurchaseConfirmation($email, $productId, $productName, $amount));
    }
    
}