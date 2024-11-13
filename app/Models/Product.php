<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * This model represents a product in the application.
 *
 * @package App\Models
 * 
 * @property int $id The unique identifier for the product.
 * @property string $product_name The name of the product.
 * @property string $product_plan_name The name of the plan (e.g., Standard Plan).
 * @property string $description A short description of the product.
 * @property int $reviews The number of reviews for the product.
 * @property float $discount_percentage The discount percentage on the product.
 * @property float|null $commission_percentage The commission percentage for partners.
 * @property array $compatibility Compatible platforms (e.g., ["macOS", "Windows", "Android"]).
 * @property array $benefits A list of benefits of the product.
 * @property string|null $learn_more_link A link to learn more about the product.
 * @property float $price The regular price of the product.
 * @property float|null $price_offer The discounted price of the product, if applicable.
 * @property float|null $price_partner The partner price for special users.
 * @property string|null $product_link A link to the product for more details.
 * @property string|null $image_url The URL of the product's image.
 * @property int $category_id The identifier for the product's category.
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_plan_name',
        'description',
        'reviews',
        'discount_percentage',
        'commission_percentage',
        'compatibility',
        'benefits',
        'learn_more_link',
        'price',
        'price_offer',
        'price_partner',
        'product_link',
        'image_url',
        'category_id',
        'product_api_id',
        'last_updated_at',
    ];

    /**
     * Get the features associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function features() 
    {
        return $this->hasMany(Features::class);
    }

    /**
     * Get the product keys associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function productKeys()
    {
        return $this->hasMany(ProductKeys::class);
    }

    /**
     * Get the category that the product belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Other methods remain unchanged
}
