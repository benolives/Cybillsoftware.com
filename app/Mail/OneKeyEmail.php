<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OneKeyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $key;

    public function __construct($key)
    {
        $this->key = $key;
        
    }
  

    public function build()
    {
        return $this->from('cybillsoftware@email.com', 'Cybill Software')
                    ->markdown('emails.key_email');
        // return $this->view('emails.key_email');
    }
}