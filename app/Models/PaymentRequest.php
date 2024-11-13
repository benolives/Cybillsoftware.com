<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;

    // Define any fillable or guarded attributes, if needed
    protected $fillable = [
        'phone',
        'amount',
        'reference',
        'description',
        'merchant_request_id',
        'checkout_request_id',
        'status',
    ];
}
