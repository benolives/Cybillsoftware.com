<?php

namespace App\Models;

// Importing necessary classes for the model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * This model represents a category in the application.
 * It is used to categorize products.
 *
 * @package App\Models
 *
 * @property int $id The unique identifier for the category.
 * @property string $name The name of the category.
 * @property string $slug A URL-friendly version of the category name.
 */
class Category extends Model
{
    // Use the HasFactory trait to enable factory features for this model
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * This property allows you to specify which attributes
     * can be mass-assigned when creating or updating a model.
     *
     * @var array
     */
    protected $fillable = [
        'name', // The name of the category
        'slug', // The URL-friendly slug for the category
    ];

    /**
     * Get the products associated with the category.
     *
     * This method defines a one-to-many relationship between
     * the Category model and the Product model, indicating that
     * a category can have multiple products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        // Return the relationship definition
        return $this->hasMany(Product::class, 'category_id');
    }
}