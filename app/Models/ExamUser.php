<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUser extends Model
{
    //
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'exam_id', 'exam_id')
                    ->where('user_id', '=', 'user_id');
    }
    protected $guarded = [];
}
