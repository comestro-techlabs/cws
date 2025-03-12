<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(MockTestQuestion::class, 'mocktest_id');
    }
    public function results()
    {
        return $this->hasMany(MockTestResult::class);
    }
}
