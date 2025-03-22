<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'batch_name', 'start_date', 'end_date', 'total_seats', 'available_seats',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'batch_id', 'user_id')
                    ->withPivot('course_id')
                    ->withTimestamps();
    }
    
}
