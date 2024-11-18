<?php
// LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

//Auth facade provides a simple interface to perform various authentication-related tasks, 
//such as logging in and out users, checking if a user is authenticated 
//and retrieving the currently authenticated user
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
        AuthenticatesUsers trait provides several functions to help us
        manage authentication such as
        1. showLoginForm: Displays the login form.
        2. login: Handles the login request.
        3. logout: Handles the logout request.
    */

    use AuthenticatesUsers;

    // Set redirect to products page after the user has successfully
    // logged into the application
    protected $redirectTo = '/select-products';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && $user->hasVerifiedEmail()) {
            Log::info('User email is verified', ['user' => $user]);
            return $this->guard()->attempt($credentials, $request->filled('remember'));       
        }

        Log::warning('User email not verified or user not found', ['email' => $request->email]);
        return false;
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.verification_needed')],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    //when a user successfully logs in this method is invoked
    //it enusers that the user's email is verified
    //and then redirects user to where redirectTo is specified
    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return redirect('/login')->with('warning', 'You need to verify your email address before logging in.');
        }

        // Redirect user based on their admin status if they are admin redirect them to dashbaord
        if ($user->is_admin) {
            // Redirect to the admin dashboard if the user is an admin
            return redirect('/admin/dashboard')->with('toast', 'Welcome back, Admin!');
        }

        // Redirect to the products page with a message for toast
        return redirect($this->redirectTo)->with('toast', 'Welcome back! Please choose the products you want to sell.');
    }

    //implement the logout method to log the user out
    public function logout(Request $request)
    {
        Auth::logout();

        //invalidate the user's session to ensure that any data associated with it is cleared.
        $request->session()->invalidate();

        //regenerate the CSRF token to protect against CSRF attacks.
        $request->session()->regenerateToken();
        
        // redirect the user back to the home page
        return redirect('/');
    }
}