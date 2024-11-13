<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function showAdminDashboard()
    {
        // Define the Kaspersky category ID (assuming you have this ID, replace as necessary)
        $kasperskyCategoryId = 11; // Replace this with the actual Kaspersky category ID if needed

        // Retrieve orders related to Kaspersky products with status 'complete'
        $orders = Order::whereHas('product', function($query) use ($kasperskyCategoryId) {
            // Filter by Kaspersky category
            $query->where('category_id', $kasperskyCategoryId);
        })
        ->where('status', 'completed') // Ensure the order status is 'complete'
        ->get();

        $totalKasperskySales = $orders->sum('amount');

        // If there is a commission calculation elsewhere (for example, in the 'clients' table),
        // you can adjust the logic to sum the commission data here as well.
        // Example:
        // $totalKasperskyCommission = $orders->sum('commission_received');

        // Pass the data to the view

        // Calculate the total Kaspersky commission (sum of commission_received in orders)
        //for now it is dummy
        $totalKasperskyCommission = 500;

        // Pass the data to the view
        return view('admin.dashboard', compact('totalKasperskySales', 'totalKasperskyCommission'));
    }
}
