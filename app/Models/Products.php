<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'points',
        'imageUrl',
        'availableQuantity',
    ];

    
    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }
}
