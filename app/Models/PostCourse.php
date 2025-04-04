<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PostCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'course_slug',

    ];

    public function chapters()
    {
        return $this->hasMany(PostChapter::class);
    }
}
