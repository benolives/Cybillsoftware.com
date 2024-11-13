<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function confirmPurchase(Request $request)
    {
        // Validate request data
        $request->validate([
            'product_id' => 'required|integer',
            'safaricom_response' => 'required|array',
        ]);

        $productId = $request->input('product_id');
        $safaricomResponse = $request->input('safaricom_response');

        // Ensure user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Send the confirmation email
        Mail::to($request->user()->email)->send(new PurchaseConfirmation($productId, $safaricomResponse));

        return response()->json(['message' => 'Purchase confirmation email sent!'], 200);
    }
}