<?php

namespace App\Models;


use Carbon\Carbon; // For handling date and time
use Illuminate\Support\Facades\Log; // For logging events
use Illuminate\Contracts\Auth\MustVerifyEmail; // Interface for email verification
use Illuminate\Database\Eloquent\Factories\HasFactory; // For factory-based model creation
use Illuminate\Foundation\Auth\User as Authenticatable; // Base class for the User model
use Illuminate\Notifications\Notifiable; // Trait for sending notifications
use Laravel\Sanctum\HasApiTokens; // For API token management
use Filament\Models\Contracts\FilamentUser; // For Filament user interface
use Filament\Panel; // For Filament panel management


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'name_of_company',
        'phone',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Cast to a datetime object
        'password' => 'hashed', // Automatically hash the password
    ];

    /*==============================================================*\
        method to send email verification notification to the user.
        This method checks if the user has verified their email.
        If not, it sends a notification using the VerifyEmail class.
    \*===============================================================*/
    public function sendEmailVerificationNotification()
    {
        if (!$this->hasVerifiedEmail()) {
            $this->notify(new \App\Notifications\VerifyEmail);
        }
    }

    /*==============================================================*\
        Mark the user's email as verified by updating email_verified_at
        timestamp to the current time and save changes to database
        Log the information for debugging and other reasons
    \*===============================================================*/
    public function markEmailAsVerified()
    {
        $this->email_verified_at = Carbon::now();
        $this->save();
        
        Log::info('Email marked as verified', [
            'user_id' => $this->id, 
            'new_verified_at' => $this->email_verified_at
        ]);
    }

    /**
     * Determine if the user can access a specific Filament panel.
     * 
     * This method checks the user's type to grant or deny access.
     * 
     * @param Panel $panel The panel to check access for
     * @return bool Returns true if the user can access the panel; otherwise, false
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->utype === 'ADM'; // Check if user type is 'ADM'
    }

    //relationship with clients
    public function clients () {
        return $this->hasMany(Client::class, 'partner_id');
    }
}