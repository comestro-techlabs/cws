<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTestResult extends Model
{
    protected $guarded = [];

    protected $casts = [
        'completed_at' => 'datetime',
    ];
    public function mockTest()
    {
        return $this->belongsTo(MockTest::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
