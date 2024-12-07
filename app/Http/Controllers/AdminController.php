<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentRequest;
use App\Models\Product;
use App\Models\Client;
use App\Models\ProductKeys;
use App\Models\Category;
use App\Models\B2BPaymentBenOlives;
use App\Models\KasperskyKey;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Render the full layout with the dashboard content
    public function loadDashboard()
    {
        $totalCustomers = Client::count();
        $totalRevenue = Client::sum('product_price');
        $totalCommissions = Client::sum('commission_received');
        $totalPartners = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
        $totalProductKeys = ProductKeys::count();
        $inStockProducts = Product::where('stock_status', 'instock')->count();
        $outOfStockProducts = Product::where('stock_status', 'outofstock')->count();
        $kasperskyCategory = Category::where('slug', 'kaspersky')->first();
        $bitdefenderCategory = Category::where('slug', 'bitdefender')->first();

        $totalkasperskyProducts = Product::where('category_id', $kasperskyCategory->id)->count();
        $totalbitdefenderProducts = Product::where('category_id', $bitdefenderCategory->id)->count();

        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        return view('admin.sections.dashboardContent', compact(
            'totalCustomers', 
            'totalRevenue', 
            'totalPartners',
            'totalCommissions',
            'totalProducts',
            'totalProductKeys',
            'outOfStockProducts',
            'inStockProducts',
            'totalkasperskyProducts',
            'totalbitdefenderProducts',
            'notifications'
        ));
    }

    //Show the partner creation form
    public function show_partner_form()
    {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        return view('admin.sections.add_partner', compact('notifications'));
    }

    //fetch all the client
    public function allClients()
    {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        //retrieve all the clients
        $allClients = Client::all();
        $products = Product::all();
        return view('admin.sections.all_clients', compact('allClients', 'products', 'notifications'));
    }
    public function kasperskyClients()
    {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Find the category with the slug 'kaspersky'
        $kasperskyCategory = Category::where('slug', 'kaspersky')->first();
        
        if (!$kasperskyCategory) {
            // If no category is found, return an empty collection
            $kasperskyClients = collect();
        } else {
            // Step 2: Get all product IDs that belong to the "Kaspersky" category
            $kasperskyProducts = Product::where('category_id', $kasperskyCategory->id)->get();
        }
        if ($kasperskyProducts->isEmpty()) {
            $kasperskyClients = collect();
        } else {
            // Step 3: Retrieve clients whose product_id matches any of the found product IDs
            // Get only the product IDs
            $productIds = $kasperskyProducts->pluck('id'); 

            // Fetch clients with the corresponding product IDs
            $kasperskyClients = Client::whereIn('product_id', $productIds)->get();
            Log::info('Checking Kaspersky clients:', $kasperskyClients->toArray());
        }

        // Return to the view with the Kaspersky clients
        return view('admin.sections.kaspersky_clients', compact('kasperskyClients', 'notifications'));
    }

    //retrieve all partners
    public function getAllPartners(Request $request) {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Start the query for non-admin users by default
        $query = User::query();
    
        // Filter based on admin or non-admin status
        if ($request->has('filter')) {
            if ($request->filter == 'admin') {
                $query->where('is_admin', 1);
            } elseif ($request->filter == 'non-admin') {
                $query->where('is_admin', 0);
            } elseif ($request->filter == 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->filter == 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }
    
        // Retrieve the filtered partners
        $allPartners = $query->get();
    
        return view('admin.sections.all_partners', compact('allPartners', 'notifications'));
    }

    //retrieve completed orders
    public function getCompletedOrders() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Fetch completed orders with their related product details
        $orders = Order::with('product')->where('status', 'completed')->get();

        // Pass the orders to the view
        return view('admin.sections.completed_orders', compact('orders', 'notifications'));
    }

    //retrieve Incompleted orders
    public function getIncompletedOrders() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Fetch incompleted orders with their related product details
        $orders = Order::with('product')->where('status', 'pending')->get();

        // Pass the orders to the view
        return view('admin.sections.pending_orders', compact('orders', 'notifications'));
    }

    //retreive payments to benolives
    public function getPaymentsToBenolives() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
        // Fetch all payments to Ben Olives
        $paymentsToBenOlives = B2BPaymentBenOlives::all();

        return view('admin.sections.payments_to_benolives', compact('paymentsToBenOlives', 'notifications'));
    }

    public function getKasperskyKeys() {
        // Get notifications for the logged-in admin (assuming the admin is logged in)
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();

        $kaspersky_keys = KasperskyKey::all();
        return view('admin.sections.kaspersky_keys', compact('notifications', 'kaspersky_keys'));
    }
}
