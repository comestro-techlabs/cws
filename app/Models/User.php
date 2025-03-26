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
                    ->withPivot('batch_id','is_subs')
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
        // Check subscription-based access first
        if ($this->hasActiveSubscription()) {
            Log::info('User has access via active subscription', ['user_id' => $this->id]);
            return true;
        }

        // Check course enrollment with full payment (non-subscription)
        $hasActiveCourseEnrollment = $this->courses()
            ->wherePivot('is_subs', false) // Full payment, not subscription
            ->whereHas('batches', function ($query) {
                $query->where('end_date', '>', now()); // Batch still active
            })
            ->exists();

        Log::info('User hasAccess check', [
            'user_id' => $this->id,
            'has_active_course_enrollment' => $hasActiveCourseEnrollment,
            'result' => $hasActiveCourseEnrollment
        ]);

        return $hasActiveCourseEnrollment;
    }
    public function getAccessStatus(): array
    {
        $status = [
            'has_access' => false,
            'reasons' => [],
            'can_view' => true // Allow viewing listings, but restrict detailed access
        ];

        // Check subscription status
        if (!$this->hasActiveSubscription()) {
            $status['reasons'][] = 'Subscription has ended or is inactive';
        }

        // Check active course enrollments
        $activeCourses = $this->courses()
            ->wherePivot('is_subs', false)
            ->whereHas('batches', function ($query) {
                $query->where('end_date', '>', now());
            })
            ->count();

        if ($activeCourses === 0) {
            $status['reasons'][] = 'No active course batches (all completed or not enrolled)';
        }

        // User has access if there are no restriction reasons
        $status['has_access'] = count($status['reasons']) === 0;

        Log::info('User getAccessStatus', [
            'user_id' => $this->id,
            'active_courses_count' => $activeCourses,
            'status' => $status
        ]);

        return $status;
    }

   

   


}
