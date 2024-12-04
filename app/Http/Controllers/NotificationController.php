<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function markAsRead($notificationId)
    {
        // Fetch the notification
        $notification = Auth::user()->notifications()->findOrFail($notificationId);

        // Mark it as read
        $notification->markAsRead();

        return response()->json(['status' => 'success']);
    }
}