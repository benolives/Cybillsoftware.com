<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BlogController;

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
        // Get the latest blogs from the BlogController (you can also directly fetch them here)
        $blogs = (new BlogController())->getLatestBlogs();

        return view('index', ['blogs' => $blogs]);
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