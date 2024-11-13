<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $productId;
    public $productName; // Declare the property
    public $amount;
    public $transactionDate;
    //public $keyCode;

    public function __construct($email, $productId, $productName, $amount, $transactionDate = null, $keyCode = null)
    {
        $this->email = $email;
        $this->productId = $productId;
        $this->productName = $productName; // Initialize this property
        $this->amount = $amount;
        $this->transactionDate = $transactionDate;
        //$this->keyCode = $keyCode; // Initialize this property
    }

    public function build()
    {
        return $this->view('emails.purchase_confirmation')
                    ->with([
                        'productId' => $this->productId,
                        'productName' => $this->productName, // Use the initialized property
                        'amount' => $this->amount,
                        'transactionDate' => $this->transactionDate,
                        //'keyCode' => $this->keyCode,
                    ]);
    }
}