<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['cat_title', 'cat_description', 'cat_slug'];


    public function setCatTitleAttribute($value)
    {
        $this->attributes['cat_title'] = $value;
        $this->attributes['cat_slug'] = Str::slug($value);
    }
}
