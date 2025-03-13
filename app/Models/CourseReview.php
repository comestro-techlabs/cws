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

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id','id');
    }
    
}
