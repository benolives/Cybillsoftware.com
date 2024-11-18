<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Render the full layout with the dashboard content
    public function loadDashboard()
    {
        return view('admin.layout', [
            'content' => view('admin.sections.dashboardContent')
        ]);
    }

    // Method to handle the AJAX request and return the correct view/section required in dashboard
    public function loadSectionContent(Request $request)
    {
        // Get the section ID from the request
        $section = $request->get('section');

        // We will use a switch statement to check the section parameter from the request 
        // and return the corresponding view.
        switch ($section) {
            case 'dashboard':
                return view('admin.sections.dashboardContent');
            case 'categories':
                return view('admin.sections.categories');
            case 'clients':
                return view('admin.sections.clients');
            case 'orders':
                return view('admin.sections.orders');
            case 'users':
                return view('admin.sections.users');
            case 'features':
                return view('admin.sections.features');
            case 'new_partner_form':
                return view('admin.sections.new_partner_form');
            default:
                return response()->json(['error' => 'Invalid section requested.'], 400);
        }
    }
}