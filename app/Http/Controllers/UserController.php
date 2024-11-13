<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class UserController extends Controller
{
    // Show the partner's dashboard to look at their performance
    public function index()
    {
        //retrieve the logged in partner
        $partner = Auth::user();
        // fetch the clients associated with the partner from the database
        $clients = $partner->clients;

        //render the dashboard page and pass an array of clients for the
        // specific partner
        return view('users.index', compact('clients'));
    }
}