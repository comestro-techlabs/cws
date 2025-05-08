<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'points',
        'imageUrl',
        'availableQuantity',
        'slug',       
        'status',
        'image_file_id'     
    ];
        public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }
        public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
