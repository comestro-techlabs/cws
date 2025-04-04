<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
