<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentRequest;
use App\Models\Product;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Render the full layout with the dashboard content
    public function loadDashboard()
    {
        $today = Carbon::today();
        
        // Calculate today's income for Kaspersky products
        $todayIncome = Order::whereHas('product', function ($query) {
            $query->where('product_name', 'Kaspersky');
        })
        ->whereDate('created_at', $today)
        ->sum('amount');

        // Calculate total revenue for Kaspersky products
        $totalRevenue = Order::whereHas('product', function ($query) {
            $query->where('product_name', 'Kaspersky');
        })->sum('amount');

        // Get new orders for Kaspersky today
        $newOrders = Order::whereHas('product', function ($query) {
            $query->where('product_name', 'Kaspersky');
        })
        ->whereDate('created_at', $today)
        ->count();

        // Get new users today
        $newUsers = User::whereDate('created_at', $today)->count();

        // Fetch payment requests related to Kaspersky for B2B payments
        $paymentRequests = PaymentRequest::where('description', 'Kaspersky')->where('status', 'completed')->get();

        return view('admin.layout', [
            'content' => view('admin.sections.dashboardContent'),
            'todayIncome' => $todayIncome,
            'totalRevenue' => $totalRevenue,
            'newOrders' => $newOrders,
            'newUsers' => $newUsers,
            'paymentRequests' => $paymentRequests,
        ]);
    }

    // Method to handle the AJAX request and return the correct view/section required in dashboard
    public function loadSectionContent(Request $request)
    {
        // Get the section ID from the request
        $section = $request->get('section');

        switch ($section) {
            case 'dashboard':
                return view('admin.sections.dashboardContent');
            case 'kaspersky_payments':
                $today = Carbon::today();
                
                // Today's income for Kaspersky products
                $todayIncome = Order::whereHas('product', function ($query) {
                    $query->where('product_name', 'Kaspersky');
                })
                ->whereDate('created_at', $today)
                ->sum('amount');

                // Total revenue from Kaspersky sales
                $totalRevenue = Order::whereHas('product', function ($query) {
                    $query->where('product_name', 'Kaspersky');
                })->sum('amount');

                // New orders for Kaspersky
                $newOrders = Order::whereHas('product', function ($query) {
                    $query->where('product_name', 'Kaspersky');
                })
                ->whereDate('created_at', $today)
                ->count();

                // New users who registered today
                $newUsers = User::whereDate('created_at', $today)->count();

                // Fetch completed payment requests for Kaspersky
                $paymentRequests = PaymentRequest::where('description', 'Kaspersky')->where('status', 'completed')->get();

                return view('admin.sections.kaspersky_payments', compact('todayIncome', 'totalRevenue', 'newOrders', 'newUsers', 'paymentRequests'));
            default:
                return response()->json(['error' => 'Invalid section requested.'], 400);
        }
    }
}
