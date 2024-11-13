<?php

namespace App\Http\Controllers\payments\mpesa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MpesaB2BController extends Controller
{

    //Get access token from Mpesa api endpoint to enable carry out other functions
    public function getAccessToken()
    {
        $consumerKey = env('MPESA_B2B_CONSUMER_KEY');
        $consumerSecret = env('MPESA_B2B_CONSUMER_SECRET');
        $credentials = base64_encode($consumerKey . ':' . $consumerSecret);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
            ])->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

            $responseData = $response->json();
            if (isset($responseData['access_token'])) {
                return $responseData['access_token'];
            } else {
                Log::error('Failed to retrieve access token in Mpesa B2B API AUTHENTICATION CALL: ' . json_encode($responseData));
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving access token: ' . $e->getMessage());
            return null;
        }
    }

    //Initiate B2B Payment to Ben Olives using M-Pesa API
    public function initiateB2B(Request $request)
    {
        // Log the productApiId before attempting to fetch the product
        Log::info('Initiating B2B Payment to Ben Olives using M-Pesa API..');

        //get the amount to pay BenOlives from the request. In the form there is
        // a hidden input that contains the amount
        $amount = $request->input('totalKasperskySales');

        //Firstly we have to authenticate with MPESA API endpoint to get Access token
        try {
            $accessToken = $this->getAccessToken();
            if (!$accessToken) {
                return response()->json(['error' => 'Failed to retrieve access token from M-PESA'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving access token: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve access token'], 500);
        }

        //SET up the necessary parameters to initiate the B2B PAYBILL MPESA API
        $url =  env('MPESA_B2B_API_URL');
        $Initiator = env('MPESA_B2B_INITIATOR');
        $SecurityCredential = env('MPESA_B2B_SECURITY_CREDENTIAL');
        $CommandID = 'BusinessPayBill';
        $SenderIdentifierType = '4';
        $RecieverIdentifierType = '4';
        $Amount = 1; //the amount we will get it from the request
        $PartyA = env('MPESA_B2B_PARTY_A');
        $PartyB = env('MPESA_B2B_PARTY_B');
        $AccountReference = env('MPESA_B2B_ACCOUNT_REFERENCE');
        $Requester = env('MPESA_B2B_REQUESTER');
        $Remarks = env('MPESA_B2B_REMARKS');
        $QueueTimeOutURL = env('MPESA_B2B_QUEUE_TIMEOUT_URL'); //url triggered incase of a timeout Icould hardcode this
        $ResultURL = env('MPESA_B2B_RESULT_CALLBACK_URL'); //This is the url called when the result is produced


        // Prepare the B2B payment data
        $data = [
            "Initiator" => $Initiator,
            "SecurityCredential" => $SecurityCredential,
            "CommandID" => $CommandID,
            "SenderIdentifierType" => $SenderIdentifierType, // M-Pesa Business
            "RecieverIdentifierType" => $RecieverIdentifierType, // M-Pesa Business
            "Amount" => $Amount, // Change this to the actual amount
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
                Log::info('B2B Business paybill response: ' . json_encode($res));

                if ($res['ResponseCode'] == '0') {   

                    return response()->json([
                        'success' => true,
                        'message' => 'Payment initiation successful.',
                        'data' => $res,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => $res['ResponseDescription'] ?? 'Payment initiation failed.',
                    ]);
                }
            } else {
                Log::error('M-Pesa API error: ' . $response->body());
                return response()->json(['error' => 'Failed to initiate B2B PAYBILL API'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error during M-Pesa API call: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initiate B2B PAYBILL API'], 500);
        }
    }

    //the callback function that will handle result url
    public function b2BCallback(Request $request) {
        Log::info('Received Result from M-Pesa: ');

        // Get all incoming request data
        $requestData = $request->all();
        return response()->json([
            'status' => 'success',
            'message' => 'Payment result received',
            'data' => $requestData // This will return all the data sent by M-Pesa
        ]);
    }

    public function PaymentProcessTimeOut(Request $request)
    {
        // Get all incoming timeout request data
        $timeoutData = $request->all();

        // Return the timeout data as a JSON response
        return response()->json([
            'status' => 'timeout',
            'message' => 'Transaction timeout occurred',
            'data' => $timeoutData // This will return all the timeout data
        ]);
    }
}