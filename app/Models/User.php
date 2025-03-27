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
        // First check if user has any active non-subscription course
        $hasActiveNonSubscriptionCourse = $this->courses()
            ->join('batches', 'batches.course_id', '=', 'courses.id')
            ->where('course_student.is_subs', false)
            ->where('batches.end_date', '>', now())
            ->where('course_student.batch_id', '=', 'batches.id')
            ->exists();

        if ($hasActiveNonSubscriptionCourse) {
            Log::info('User has access via active non-subscription course', ['user_id' => $this->id]);
            return true;
        }

        // If no active non-subscription course, check subscription
        if ($this->hasActiveSubscription()) {
            $hasActiveSubscriptionBatches = $this->courses()
                ->join('batches', 'batches.course_id', '=', 'courses.id')
                ->where('course_student.is_subs', true)
                ->where('batches.end_date', '>', now())
                ->where('course_student.batch_id', '=', 'batches.id')
                ->exists();

            if ($hasActiveSubscriptionBatches) {
                Log::info('User has access via active subscription with active batches', ['user_id' => $this->id]);
                return true;
            }
        }

        Log::info('User does not have access', ['user_id' => $this->id]);
        return false;
    }

    public function getAccessStatus(): array
    {
        $status = [
            'has_access' => false,
            'reasons' => [],
            'can_view' => true
        ];

        // Check for active non-subscription course first
        $activeNonSubscriptionBatches = $this->courses()
            ->join('batches', 'batches.course_id', '=', 'courses.id')
            ->where('course_student.is_subs', false)
            ->where('batches.end_date', '>', now())
            ->where('course_student.batch_id', '=', 'batches.id')
            ->count();

        if ($activeNonSubscriptionBatches > 0) {
            $status['has_access'] = true;
            Log::info('User has access via active non-subscription course', ['user_id' => $this->id]);
            return $status;
        }

        // Only check subscription if no active non-subscription courses
        if ($this->hasActiveSubscription()) {
            $activeSubscriptionBatches = $this->courses()
                ->join('batches', 'batches.course_id', '=', 'courses.id')
                ->where('course_student.is_subs', true)
                ->where('batches.end_date', '>', now())
                ->where('course_student.batch_id', '=', 'batches.id')
                ->count();

            if ($activeSubscriptionBatches === 0) {
                $status['reasons'][] = 'No active batches for subscription-based courses';
            }
        } else {
            $status['reasons'][] = 'No active subscription';
        }

        $status['has_access'] = count($status['reasons']) === 0;

        Log::info('User getAccessStatus', [
            'user_id' => $this->id,
            'status' => $status
        ]);

        return $status;
    }
}
