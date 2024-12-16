<?php

use Illuminate\Notifications\Notification;

class ErrorWarningNotification extends Notification
{
    public $message;
    public $type;  // Error or Warning

    public function __construct($message, $type)
    {
        $this->message = $message;
        $this->type = $type; // e.g. 'error', 'warning'
    }

    // Define the notification channels (Database for this case)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Define the notification content
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'type' => $this->type,  // Error or Warning
            'created_at' => now(),
        ];
    }
}