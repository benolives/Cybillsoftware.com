<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the session has a 'status' key indicating the user has registered
        // or if the current request is for the email verification page
        if ($request->session()->has('status') || $request->is('verifyEmail')) {
            // If either condition is true, allow the request to proceed to the next middleware/handler
            return $next($request);
        }
    
        // Check if the user is authenticated (logged in)
        if ($request->user()) {
            // If the user is logged in, allow the request to proceed
            return $next($request);
        }
    
        // If neither condition is met (user is not registered and not logged in),
        // redirect the user to the login page with an error message
        return redirect('/login')->with('error', 'You must register first.');
    }    
}
