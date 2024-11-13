<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'email',
        'phone_number',
        'amount',
        'status',
        'checkout_request_id',
        'transaction_date',
        'mpesa_receipt_number',
        'result_description',
    ];

    /**
     * Get the product that belongs to the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
  
}