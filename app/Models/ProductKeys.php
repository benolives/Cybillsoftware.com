<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductKeys extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'key_code',
        'sold_status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getKeyByProductId($productId)
    {
        return static::where('product_id', $productId)->first();
    }
}
