<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KeyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $key;
    public $mailData;
    public $productKeys;

    // public function __construct($key)
    // {
    //     $this->key = $key;
        
    // }
    public function __construct($mailData, $productKeys)
    {
        $this->mailData = $mailData;
        $this->productKeys = $productKeys;
    }

    public function build()
    {
        return $this->from('info@cybillsoftware@gmail.com', 'Cybill Software')
                    ->markdown('emails.key_email');
        return $this->view('emails.key_email');
    }
}