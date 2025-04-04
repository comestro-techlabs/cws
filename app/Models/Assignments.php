<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['due_date'];

    // Define the relationship: An Assignment belongs to a Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function uploads()
    {
        return $this->hasMany(Assignment_upload::class, 'assignment_id', 'id');
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function assignmentUploads()
    {
        return $this->hasMany(Assignment_upload::class, 'assignment_id', 'id');
    }

    public function isOverdue()
    {
        return $this->due_date && now()->isAfter($this->due_date);
    }

    public function getRemainingDaysAttribute()
    {
        if (!$this->due_date) {
            return null;
        }
        return now()->diffInDays($this->due_date, false);
    }
}
