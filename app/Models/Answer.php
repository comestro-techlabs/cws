<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
    public function exam()
{
    return $this->belongsTo(Exam::class);
}
}
