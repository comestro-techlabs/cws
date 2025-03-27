<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'course_type' => 'offline'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'datetime', 
        'end_date' => 'datetime'
    ];

    public function isOnline()
    {
        return $this->course_type === 'online';
    }

    public function isOffline() 
    {
        return $this->course_type === 'offline';
    }

    public function getMeetingDetailsAttribute()
    {
        if ($this->isOnline()) {
            return [
                'link' => $this->meeting_link,
                'id' => $this->meeting_id,
                'password' => $this->meeting_password
            ];
        }
        return null;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    /**
     * Get the user associated with the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'course_feature');
    }

    // A Course has many Chapters
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function rating(){
        return $this->hasMany(CourseReview::class,'course_id','id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id')
            ->withPivot('batch_id')
            ->withTimestamps();
    }

    public function getCourseProgressAttribute()
    {
        // Check if the course exists
        if (!$this->course) {
            return 0; // If no course found, return 0% progress
        }

        // Ensure the course has a duration
        if (!$this->course->duration || $this->course->duration <= 0) {
            return 0; // Avoid division by zero
        }

        // Convert duration to days (assuming it's in weeks)
        $totalDays = $this->course->duration * 7;

        // Get start date from payment
        $startDate = $this->payment_date ? \Carbon\Carbon::parse($this->payment_date) : null;

        // Ensure startDate is valid
        if (!$startDate) {
            return 0;
        }

        $currentDate = \Carbon\Carbon::now();
        $elapsedDays = $startDate->diffInDays($currentDate);

        // Calculate progress percentage
        $progress = ($elapsedDays / $totalDays) * 100;

        // Ensure progress does not exceed 100%
        return min(100, max(0, round($progress)));
    }

    public function getProgressAttribute()
    {
        $payment = $this->payments()->latest()->first(); // Get latest payment
        return $payment ? $payment->course_progress : 100;
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignments::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id')
                    ->withPivot('batch_id','is_subs')
                    ->withTimestamps();
    }

    public function mockTests()
    {
        return $this->hasMany(MockTest::class);
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}