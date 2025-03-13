<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'review',
        'rating'
    ];
    
}
