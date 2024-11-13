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
    protected $redirectTo = '/products';

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
    public function sendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

   /*======================================================================
        Show the email verification page after registration to notify
        partner of the email that has been sent to their email they provided
        if the user is has been verified redirect the user to the products page.
    */
    public function show(Request $request)
    {
        // Get the email from the request
        $email = $request->input('email');

        // Return the blade page and pass the email
        return view('auth.verify-email', ['email' => $email]);
    }

    /*==========================================================================
        Resend the verification to the email incase the partner did not get it at
        first attempt.
    */
    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice')->with('message', 'A new verification email has been sent.');    
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
        return redirect()->route('products.index')->with('toast', 'Your email has been verified. Welcome!');
    }
}