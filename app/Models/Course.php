<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payments()
{
    return $this->hasMany(Payment::class);
}

    public function students()
    {
        return $this->belongsToMany(User::class);
    }
    /**
     * Get the user associated with the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'course_feature');
    }

    // A Course has many Chapters
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}
