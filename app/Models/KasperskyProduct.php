<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasperskyProduct extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'kaspersky_products';

    // Define the fillable attributes for mass assignment.
    protected $fillable = [
        'product_api_id',
        'name',
        'price',
        'description',
        'last_updated_at',
    ];

    // Automatically cast date attributes to Carbon instances so that we can easily work
    // with them as dates
    protected $dates = [
        'created_at',
        'updated_at',
        'last_updated_at',
    ];

    // Enforce uniqueness of the 'product_api_id' field and prevent duplicate entries
    public static function boot()
    {
        parent::boot();

        // Automatically set default description if missing when creating a product
        static::creating(function ($product) {
            if (empty($product->description)) {
                $product->description = 'No description available';
            }
        });
    }
}