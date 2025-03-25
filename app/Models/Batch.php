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
                    ->withPivot('course_id', 'is_subs')
                    ->join('courses', 'courses.id', '=', 'course_student.course_id')
                    ->select('users.*', 'courses.course_type')
                    ->withTimestamps();
    }

    public function getOfflineStudentsAttribute()
    {
        return $this->users()
                    ->where('courses.course_type', 'offline')
                    ->get();
    }

    public function getOnlineStudentsAttribute()
    {
        return $this->users()
                    ->where('courses.course_type', 'online')
                    ->get();
    }
}
