<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship: An Assignment belongs to a Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function uploads()
    {
        return $this->hasMany(Assignment_upload::class, 'assignment_id', 'id');
    }

}
