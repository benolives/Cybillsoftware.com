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
    use AuthenticatesUsers;

    protected $redirectTo = '/select-products';

    public function __construct()
    {
        //
    }

    //override the default attemptLogin function from AuthenticatesUsers
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

    //This method handles the response when a login attempt fails.
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            // Redirect back with a message to show the user needs to verify their email
            return redirect()->route('login')->with([
                'verification_needed' => 'You need to verify your email address before logging in. Please check your inbox or spam folder.',
                'email_for_verification' => $user->email
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    //This method is called after the user successfully logs in
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