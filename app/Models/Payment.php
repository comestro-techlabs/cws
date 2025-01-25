<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'student_id',
    //     'course_id',
    //     'amount',
    //     'payment_option',
    //     'installment_number',
    //     'payment_date',
    // ];
   

    protected $guarded = [];

    // protected $casts = [
    //     'payment_date' => 'datetime',
    // ];

    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->payment_date)->format('Y-m-d');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
     public function workshops(){
        return $this->belongsToMany(workshop::class);
     }
     public function getCourseProgressAttribute()
     {
         // Assuming the duration of the course is in weeks
         $totalDays = $this->course->duration * 7; // Total course duration in days (weeks * 7)
     
         // Get the start date from the payment's created_at field (when the student registered)
         $startDate = \Carbon\Carbon::parse($this->payment_date); // Using payment created_at as registration date
         $currentDate = \Carbon\Carbon::now(); // Current date
     
         // Ensure the difference in days is always positive by using abs()
         $elapsedDays = abs($currentDate->diffInDays($startDate)); // Absolute difference in days
     
         // If the course is completed, return 100%
         if ($elapsedDays >= $totalDays) {
             return 100;
         }
     
         // Otherwise, calculate the percentage of the course that has passed
         $progress = ($elapsedDays / $totalDays) * 100;
     
         // Ensure the progress does not exceed 100%
         $progress = min(100, $progress);
     
         // Return the rounded progress percentage
         return round($progress, 2);
     }
     

  
}
