<?php

namespace App\Models;

use Dotenv\Repository\Adapter\GuardedWriter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    protected $guarded = [];
    // public function courses(): BelongsToMany
    // {
    //     return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id')->withPivot('batch_id')
    //     ->withTimestamps();
    // }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
   

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
    public function examUser()
    {
        return $this->hasMany(ExamUser::class); // Changed from belongsTo to hasMany
    }
    
}
