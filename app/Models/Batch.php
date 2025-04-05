<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'course_id',      // Foreign key to courses table
        'batch_name',     // Name/identifier of the batch
        'start_date',     // Batch start date
        'end_date',       // Batch end date
        'total_seats',    // Total available seats in batch
        'available_seats' // Currently available seats
    ];

    // Automatic date casting
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student')
                    ->where('course_student.batch_id', $this->id);
    }
    // Relationship: Batch belongs to a Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship: Many-to-Many with Users through course_student table
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'batch_id', 'user_id')
                    ->withPivot('course_id', 'is_subs')
                    ->join('courses', 'courses.id', '=', 'course_student.course_id')
                    ->select('users.*', 'courses.course_type')
                    ->withTimestamps();
    }

    // Get only offline students for this batch
    public function getOfflineStudentsAttribute()
    {
        return $this->users()
                    ->where('courses.course_type', 'offline')
                    ->get();
    }

    // Get only online students for this batch
    public function getOnlineStudentsAttribute()
    {
        return $this->users()
                    ->where('courses.course_type', 'online')
                    ->get();
    }
}