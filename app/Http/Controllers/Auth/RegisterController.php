<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Base controller class
use App\Models\User; // User model for interacting with the users table
use Illuminate\Foundation\Auth\RegistersUsers; // Trait that provides registration functionality
use Illuminate\Support\Facades\Hash; // Hashing functionality for passwords
use Illuminate\Support\Facades\Validator; // Validator for input validation
use Illuminate\Auth\Events\Registered; // Event triggered upon user registration
use Illuminate\Http\Request; // Request class for handling HTTP requests
use Illuminate\Support\Facades\Log; // Logging functionality
use Illuminate\Support\Facades\Auth;

// Import the custom rule
use App\Rules\NotStartWith;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        Log::info('Registration attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'phone_number' => $request->phone,
            'user_agent' => $request->header('User-Agent'),
            'timestamp' => now(),
            'referrer' => $request->header('Referer'),
            'method' => $request->input('method'),
        ]);        


        try {
            $this->validator($request->all())->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Registration validation failed', [
                'ip' => $request->ip(),
                'errors' => $e->errors(),
            ]);
            // Redirect back with validation errors and a toast query parameter indicating failure
            return redirect()->route('register')->withErrors($e->errors())->with('toast', 'error');
        }

        // Create the user also from RegistersUsers trait
        $user = $this->create($request->all());

        // Send the email verification notification this method is
        // defined in the user model
        $user->sendEmailVerificationNotification();

        // Redirect to the verification notice page and pass the user email
        return redirect()->route('verification.notice', ['email' => $user->email]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name_of_company' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[7]\d{8}$/'],
        ]);
    }

    // User creation/registration logic
    protected function create(array $data)
    {
        // Prepend '254' to the phone number received from the user input
        // Here, $data['phone'] should be the 9-digit number
        $phone = '254' . $data['phone'];
        

        // Ensure the phone number is in the correct format (must start with 254)
        if (strlen($phone) !== 12 || substr($phone, 0, 3) !== '254') {
            throw new \Exception('Invalid phone number format');
        }
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name_of_company' => $data['name_of_company'],
            'phone' => $phone,
        ]);
    }
}