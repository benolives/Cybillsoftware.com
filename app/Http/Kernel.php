<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \App\Http\Middleware\RedirectIfAuthenticated::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ],
    ];

    /*===========================================================================================================\
     * The application's middleware aliases.
     *
     * Middleware aliases allow developers to conveniently assign middleware to routes and route groups
     * using a simple string identifier instead of the full class name. This improves code readability and 
     * makes route definitions cleaner.
     *
     * Each alias corresponds to a specific middleware class responsible for handling various aspects 
     * of request processing, such as authentication, authorization, session management, and request throttling.
     *
     * @var array<string, class-string|string>
    \===========================================================================================================*/
    protected $middlewareAliases = [
        /**
         * 'auth.admin' alias for checking if the user is an authenticated admin.
         * This middleware ensures that the user has admin privileges.
        **/
        'auth.admin' => \App\Http\Middleware\AuthAdmin::class,

        /**
         * 'auth' alias for the standard authentication middleware.
         * This middleware checks if the user is authenticated and redirects to the login page if not.
        **/
        'auth' => \App\Http\Middleware\Authenticate::class,

        /**
         * 'auth.basic' alias for basic HTTP authentication middleware.
         * This middleware provides a simple way to authenticate users with a username and password.
        **/
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

        /**
         * 'auth.session' alias for managing user session authentication.
         * This middleware ensures that the user's session is authenticated.
        **/
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,

        /**
         * 'cache.headers' alias for setting HTTP cache headers.
         * This middleware manages the cache-control headers for HTTP responses.
        **/
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,

        /**
         * 'can' alias for authorization middleware.
         * This middleware checks if the authenticated user has the necessary permissions to perform a given action.
        **/
        'can' => \Illuminate\Auth\Middleware\Authorize::class,

        /**
         * 'guest' alias for redirecting authenticated users.
         * This middleware redirects users who are already authenticated to a specified location (e.g., home).
        **/
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        /**
         * 'password.confirm' alias for requiring password confirmation.
         * This middleware prompts users to confirm their password before performing sensitive actions.
        **/
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

        /**
         * 'precognitive' alias for handling precognitive requests.
         * This middleware processes requests that are made in anticipation of future actions, improving responsiveness.
        **/
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,

        /**
         * 'signed' alias for validating signed URLs.
         * This middleware ensures that a given URL is signed and valid.
        **/
        'signed' => \App\Http\Middleware\ValidateSignature::class,

        /**
         * 'throttle' alias for request throttling.
         * This middleware limits the number of requests a user can make to prevent abuse.
        **/
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        /**
         * 'verified' alias for ensuring email verification.
         * This middleware checks if the authenticated user's email address has been verified.
        **/
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    /*
        By adding CheckRegistration middleware to $routeMiddleware, we ensure that it only runs for 
        routes where it is explicitly applied. This is more efficient and aligns with best practices
        for middleware usage in Laravel.
    */
    protected $routeMiddleware = [
        'check.registration' => \App\Http\Middleware\CheckRegistration::class,
    ];
}