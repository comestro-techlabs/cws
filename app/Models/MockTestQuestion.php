<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTestQuestion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'options' => 'array'
    ];
    public function mockTest()
    {
        return $this->belongsTo(MockTest::class);
    }
}
