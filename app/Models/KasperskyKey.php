<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasperskyKey extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'kaspersky_keys';

    protected $primaryKey = 'id';

    public $timestamps = true;

    // The attributes that are mass assignable.
    protected $fillable = [
        'product_id',
        'key_code',
        'sold_status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
