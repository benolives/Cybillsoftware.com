<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends VerifyEmailBase
{
    public function __construct()
    {
        //
    }

    /*==============================================================*\
        Build the email notification. Log the recipients email and
        verification Url for debugging purpose and then send a mail 
        message with all contents
    \*===============================================================*/
    public function toMail($notifiable)
    {
        Log::info('Sending verification email to: ' . $notifiable->email);
        $verificationUrl = $this->verificationUrl($notifiable);
        Log::info('Verification URL: ' . $verificationUrl);

        return (new MailMessage)
                    ->subject('Verify Email Address')
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email Address', $verificationUrl)
                    ->line('If you did not create an account, no further action is required.')
                    ->view('emails.verify', ['verificationUrl' => $verificationUrl, 'notifiable' => $notifiable]);
    }

    /*==============================================================*\
        This method generates a temporary signed URL for the user 
        to verify their email. The URL is valid for 60 minutes, 
        after which it will expire. It includes the user's ID and 
        a hash of their email (using sha1) for security, ensuring 
        that the verification link cannot be easily forged.
    \*===============================================================*/
    
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}