<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class AppController
 * 
 * This controller handles the application's main views and interactions.
 */
class AppController extends Controller
{
    /**
     * Display the index view.
     *
     * This method returns the main index view of the application,
     * which serves as the entry point for users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }
    public function show_About_us()
    {
        return view('about_us');
    }
    public function show_Contact_us()
    {
        return view('contact_us');
    }
}