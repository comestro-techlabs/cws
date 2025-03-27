<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'contact',
        'dob',
        'gender',
        'password',
        'referral',
        'education_qualification',
        'is_member',
        'gem',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id')
            ->withPivot('batch_id', 'is_subs')
            ->withTimestamps();
    }

    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(Batch::class, 'course_student', 'user_id', 'batch_id')
            ->withPivot('course_id')
            ->withTimestamps();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function uploads()
    {
        return $this->hasMany(Assignment_upload::class, 'student_id');
    }

    public function mockTestResults()
    {
        return $this->hasMany(MockTestResult::class);
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('payment_status', 'completed')
            ->where('ends_at', '>', now())
            ->latest();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function hasActiveSubscription()
    {
        $subscription = $this->currentSubscription;
        return $subscription
            && $subscription->payment_status === 'completed'
            && $subscription->ends_at > now();
    }

    public function exams()
    {
        return $this->hasMany(ExamUser::class, 'user_id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function hasAccess(): bool
    {
        // Check if user has an active subscription
        if ($this->hasActiveSubscription()) {
            Log::info('User has access via active subscription', ['user_id' => $this->id]);
            return true;
        }
    
        // Check for any course (subscription or non-subscription) with an active batch
        $hasActiveCourse = $this->courses()
            ->join('batches', 'batches.course_id', '=', 'courses.id')
            ->where('batches.end_date', '>', now())
            ->where('course_student.batch_id', '=', 'batches.id')
            ->exists();
    
        if ($hasActiveCourse) {
            Log::info('User has access via at least one active course', ['user_id' => $this->id]);
            return true;
        }
    
        Log::info('User does not have access - no active subscription or courses', ['user_id' => $this->id]);
        return false;
    }

    public function getAccessStatus(): array
    {
        $status = [
            'has_access' => false,
            'reasons' => [],
            'can_view' => true
        ];
    
        // Check subscription
        $hasActiveSubscription = $this->hasActiveSubscription();
        if ($hasActiveSubscription) {
            $status['has_access'] = true;
            Log::info('User has access via active subscription', ['user_id' => $this->id]);
            return $status;
        } else {
            $status['reasons'][] = 'No active subscription';
        }
    
        // Check for any active course (subscription or non-subscription)
        $activeCourses = $this->courses()
            ->join('batches', 'batches.course_id', '=', 'courses.id')
            ->where('batches.end_date', '>', now())
            ->where('course_student.batch_id', '=', 'batches.id')
            ->count();
    
        if ($activeCourses > 0) {
            $status['has_access'] = true;
            Log::info('User has access via at least one active course', ['user_id' => $this->id]);
        } else {
            $status['reasons'][] = 'No active courses with active batches';
        }
    
        Log::info('User getAccessStatus', [
            'user_id' => $this->id,
            'active_courses_count' => $activeCourses,
            'status' => $status
        ]);
    
        return $status;
    }
}
