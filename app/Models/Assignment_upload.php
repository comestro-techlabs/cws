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
        return $this->belongsTo(Assignments::class, 'assignment_id', 'id');
    }
    protected $casts = [
        'submitted_at' => 'datetime',
    ];
}
