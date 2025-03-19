<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guareded = [];

        public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }
        public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
