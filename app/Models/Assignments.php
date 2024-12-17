<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Assignments extends Model
{
    //
    use HasFactory;
    protected $guarded = [];
    public function course(): HasOne
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
    

}
