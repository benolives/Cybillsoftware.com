<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/select-products';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Send the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function show(Request $request)
    {
        // Get the email from the request
        $email = $request->input('email');

        // Retrieve the user by email
        $user = User::where('email', $email)->first();

        // Check if the user exists and if their email is verified
        if ($user && $user->hasVerifiedEmail()) {
            // If email is verified, redirect them to select-products page
            return redirect()->route('select-products');
        }

        // If email is not verified, send a session toast message
        session()->flash('toast', [
            'type' => 'error',
            'message' => 'Not yet verified. Please check your inbox or spam for the verification link.'
        ]);

        // Return the verification page with the email
        return view('auth.verify-email', ['email' => $email]);
    }

    //resend verification link for emails
    public function resendVerificationEmail(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        // Retrieve the email from the POST request
        $email = $request->input('email');
        
        $user = User::where('email', $email)->first();

        if ($user && !$user->hasVerifiedEmail()) {
            // Resend the verification email
            $user->sendEmailVerificationNotification();
            Log::info('YOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO');
            return redirect()->route('verification.notice')->with([
                'message', 'A new verification email has been sent.',
                'email', $email
            ]);  
        }
        return redirect()->route('login')->with('status', 'Your email is already verified or email address not found.'); 
    }

    /*==================================================================================================
     * Verify the email address of the user.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming request instance.
     * @return \Illuminate\Http\Response  A redirect response indicating the result of the verification.
    */
    
    public function verify(Request $request)
    {
        // Log the start of the verification process along with request details.
        Log::info('Verification process started', ['request' => $request->all()]);

        // Retrieve the user based on the ID provided in the verification link.
        $user = User::findOrFail($request->route('id'));

        // Validate the hash to ensure the verification link is legitimate.
        if (!hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
            // Log a warning for a hash mismatch and redirect to login with an error message.
            Log::warning('Verification hash does not match', ['user' => $user]);
            return redirect('/login')->withErrors(['email' => 'Verification failed. Invalid verification link.']);
        }

        // Mark the user's email as verified.
        $user->markEmailAsVerified();
        
        // Fire the Verified event for additional processing, if necessary.
        event(new Verified($user));

        // Automatically log in the user after successful verification.
        auth()->login($user);

        // Redirect the user to the products page with a success message.
        return redirect()->route('select-products')->with('toast', 'Your email has been verified. Welcome!');
    }
}