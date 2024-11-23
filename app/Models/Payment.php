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

}
