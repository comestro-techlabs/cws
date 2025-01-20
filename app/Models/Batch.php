<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'batch_name', 'start_date', 'end_date', 'total_seats', 'available_seats',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
