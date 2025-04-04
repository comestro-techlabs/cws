<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    //

    protected $fillable = [
        'title',
        'date',
        'time',
        'image',
        'active',
        'fees',
        'description',
        'status'
    ];

    protected $dates = ['date']; // Add this
    protected $casts = [
        'active' => 'boolean',
        'date' => 'date:Y-m-d', // Ensure proper date casting
        'description'=>'array',
    ];
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    

}
