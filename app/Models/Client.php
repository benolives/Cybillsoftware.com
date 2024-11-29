<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'partner_name',
        'name',
        'email',
        'phone',
        'country',
        'town',
        'address',
        'product_category',
        'product_price',
        'commission_received',
        'subscription_type',
        'expires_at',
        'checkout_request_id',
        'status',
    ];

    // The "boot" method is used to register model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate the subscriberId before creating a client
        static::creating(function ($client) {
            // Generate the subscriberId (e.g., subscriber12348sz)
            $client->subscriberId = 'subscriber' . rand(10000, 99999) . 'sz';
        });
    }

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}