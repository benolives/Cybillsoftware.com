<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Add this line
use App\Models\Client;

class ClientController extends Controller
{
    public function create()
{
    return view('client'); // Ensure this points to your Blade view file
}

  public function Store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'client_name' => 'required|string|max:255',
        'client_email' => 'required|email|unique:clients,email', // Check if email is unique in the clients table
        'client_phone' => 'required|string|max:20',
        'product_name' => 'required|string|max:255', 
        'product_price' => 'required|numeric|min:0', 
        'commission_received' => 'required|numeric|min:0', 
        'subscription_type' => 'required|in:monthly,annually',
    ]);

    // Get the authenticated user
    $user = Auth::user();

    // Create a new client record
    Client::create([
        'partner_id' => $user->id,
        'partner_name' => $user->name,
        'name' => $validatedData['client_name'],
        'email' => $validatedData['client_email'],
        'phone' => $validatedData['client_phone'],
        'product_name' => $validatedData['product_name'],               // New field
        'product_price' => $validatedData['product_price'], 
        'commission_received' => $validatedData['commission_received'], // New field
        'subscription_type' => $validatedData['subscription_type'],
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Client information saved successfully.');
}



}