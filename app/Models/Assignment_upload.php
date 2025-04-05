<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment_upload extends Model
{

    use HasFactory;
    protected $guarded = [];

    // Define the relationship: An Assignment belongs to a Course
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function assignment()
    {
        return $this->belongsTo(Assignments::class, 'assignment_id')
            ->whereHas('course.batches', function($query) {
                $query->whereHas('students', function($q) {
                    $q->where('users.id', $this->student_id);
                });
            });
    }

    // Get batch through assignment
    public function batch()
    {
        return $this->hasOneThrough(
            Batch::class,
            Assignments::class,
            'id', // Foreign key on assignments table
            'course_id', // Foreign key on batches table
            'assignment_id', // Local key on assignment_uploads table
            'course_id' // Local key on assignments table
        );
    }

    // Scope for current batch assignments
    public function scopeCurrentBatch($query)
    {
        return $query->whereHas('assignment.course.batches', function($q) {
            $q->where('end_date', '>=', now())
                ->whereHas('students', function($sq) {
                    $sq->where('users.id', $this->student_id);
                });
        });
    }
    protected $casts = [
        'submitted_at' => 'datetime',
    ];
    public function assignmentUploads()
    {
        return $this->hasMany(Assignment_upload::class, 'assignment_id', 'id');
    }

    public function getSubmissionStatusAttribute()
    {
        if (!$this->assignment->due_date) {
            return 'submitted';
        }

        $submittedDate = $this->submitted_at;
        $dueDate = $this->assignment->due_date;

        if ($submittedDate > $dueDate) {
            return 'overdue';
        }

        return 'on-time';
    }

    public function getDaysLateAttribute()
    {
        if (!$this->assignment->due_date || $this->submission_status !== 'overdue') {
            return 0;
        }

        return $this->submitted_at->diffInDays($this->assignment->due_date);
    }

}
