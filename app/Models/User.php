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
        // Check subscription with active batches
        if ($this->hasActiveSubscription()) {
            $hasActiveSubscriptionBatches = $this->courses()
                ->wherePivot('is_subs', true)
                ->whereHas('batches', function ($query) {
                    $query->where('end_date', '>', now());
                })
                ->exists();

            if ($hasActiveSubscriptionBatches) {
                Log::info('User has access via active subscription with active batches', ['user_id' => $this->id]);
                return true;
            }
        }

        // Check non-subscription courses with active batches
        $hasActiveNonSubscriptionEnrollment = $this->courses()
            ->wherePivot('is_subs', false)
            ->whereHas('batches', function ($query) {
                $query->where('end_date', '>', now());
            })
            ->exists();

        Log::info('User hasAccess check (non-subscription)', [
            'user_id' => $this->id,
            'has_active_non_subscription_enrollment' => $hasActiveNonSubscriptionEnrollment,
            'result' => $hasActiveNonSubscriptionEnrollment
        ]);

        return $hasActiveNonSubscriptionEnrollment;
    }

    public function getAccessStatus(): array
    {
        $status = [
            'has_access' => false,
            'reasons' => [],
            'can_view' => true
        ];

        // Check subscription and subscription-based courses
        if ($this->hasActiveSubscription()) {
            $activeSubscriptionCourses = $this->courses()
                ->wherePivot('is_subs', true)
                ->whereHas('batches', function ($query) {
                    $query->where('end_date', '>', now());
                })
                ->count();

            if ($activeSubscriptionCourses === 0) {
                $status['reasons'][] = 'No active batches for subscription-based courses';
            }
        } else {
            $status['reasons'][] = 'No active subscription for subscription-based courses';
        }

        // Check non-subscription courses
        $activeNonSubscriptionCourses = $this->courses()
            ->wherePivot('is_subs', false)
            ->whereHas('batches', function ($query) {
                $query->where('end_date', '>', now());
            })
            ->count();

        if ($activeNonSubscriptionCourses === 0) {
            $status['reasons'][] = 'No active batches for non-subscription courses';
        }

        $status['has_access'] = count($status['reasons']) === 0;

        Log::info('User getAccessStatus', [
            'user_id' => $this->id,
            'active_non_subscription_courses_count' => $activeNonSubscriptionCourses,
            'status' => $status
        ]);

        return $status;
    }
}
