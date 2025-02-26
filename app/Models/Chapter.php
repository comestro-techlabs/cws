<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title'];
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function hasLessons()
    {
        return $this->lessons()->count() > 0;
    }

    // Get lesson count
    public function getLessonCount()
    {
        return $this->lessons()->count();
    }
}
