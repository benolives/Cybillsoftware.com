<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('admin.sections.dashboard');
    }

    // Clients
    public function clients()
    {
        return view('admin.sections.clients');  // A partial view for the clients section
    }

    public function orders()
    {
        return view('admin.sections.orders');
    }

    public function users()
    {
        return view('admin.sections.users');
    }
    // Product Management
    public function categories()
    {
        return view('admin.sections.categories'); // Create a view for categories
    }

    public function features()
    {
        return view('admin.sections.features'); // Create a view for features
    }

    public function productKeys()
    {
        return view('admin.sections.product-keys'); // Create a view for product keys
    }

    public function products()
    {
        return view('admin.sections.products'); // Create a view for products
    }

    // Transactions
    public function sales()
    {
        return view('admin.sections.sales'); // Create a view for sales
    }

    public function profits()
    {
        return view('admin.sections.profits'); // Create a view for profits
    }

    public function commissions()
    {
        return view('admin.sections.commissions'); // Create a view for commissions
    }

    // Notifications (optional)
    public function notifications()
    {
        return view('admin.sections.notifications'); // Create a view for notifications
    }
}