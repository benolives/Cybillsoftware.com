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
    

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }
}