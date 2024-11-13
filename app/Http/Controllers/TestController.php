<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function testEmail()
    {
        Mail::raw('This is a test email', function ($message) {
            $message->to('gababoabdiaelemal@gmail.com') // Replace with your email address
                    ->subject('Test Email');
        });

        return 'Email sent!';
    }
}