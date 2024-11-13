<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * This method determines the appropriate redirection for users who attempt to access
     * protected routes without being authenticated. If the request expects a JSON response,
     * typically for API requests, it will return null, preventing redirection and allowing 
     * the application to respond with an appropriate error message (usually a 401 Unauthorized).
     * Otherwise, it will redirect the user to the login route.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming request instance.
     * @return string|null  The URL to redirect to or null if no redirection is required.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if the request expects a JSON response (e.g., for API requests).
        if ($request->expectsJson()) {
            // Do not redirect; return null to handle the response with an error.
            return null;
        }
        
        // For non-JSON requests, redirect to the login route.
        return route('login');
    }
}