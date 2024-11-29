<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2BPaymentBenOlives extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'b2b_payments_benolives';

    // The attributes that are mass assignable (i.e., can be set in a create or update operation)
    protected $fillable = [
        'transaction_id',
        'originator_conversation_id',
        'conversation_id',
        'amount',
        'account_balance',
        'currency_code',
        'beneficiary_name',
        'beneficiary_paybill',
        'product_id',
        'client_id',
        'charges',
        'transaction_status',
        'result_code',
        'result_desc',
        'transaction_completed_time',
        'transaction_reference_number',
    ];

    // Define relationships if necessary (foreign keys, etc.)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    //relationship with cleints
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // retreive only successful transactions
    public function scopeSuccessful($query)
    {
        return $query->where('transaction_status', 'success');
    }
}