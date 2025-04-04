<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
        'image',
        'status',
        'barcode'
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
            ->withPivot('batch_id','batch_updated', 'is_subs')
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
        $hasActiveSubscription = $this->hasActiveSubscription();

        $hasActiveNonSubscriptionCourse = $this->courses()
            ->leftJoin('batches', 'course_student.batch_id', '=', 'batches.id')
            ->where('course_student.is_subs', false)
            ->where('batches.end_date', '>', now())
            ->exists();

        $hasAccess = $hasActiveSubscription || $hasActiveNonSubscriptionCourse;

        Log::info('User access check', [
            'user_id' => $this->id,
            'has_access' => $hasAccess
        ]);

        return $hasAccess;
    }
    public function getAccessStatus(): array
    {
        $status = [
            'has_access' => false,
            'reasons' => [],
            'can_view' => true,
            'renewal_needed' => false
        ];

        $hasActiveSubscription = $this->hasActiveSubscription();

        $activeNonSubscriptionCourses = $this->courses()
            ->leftJoin('batches', 'course_student.batch_id', '=', 'batches.id')
            ->where('course_student.is_subs', false)
            ->where('batches.end_date', '>', now())
            ->count();

        if ($hasActiveSubscription || $activeNonSubscriptionCourses > 0) {
            $status['has_access'] = true;
        } else {
            $status['reasons'] = ['No active subscription', 'No non-subscription courses with active batches'];
            $status['renewal_needed'] = true;
        }

        Log::info('User access status', [
            'user_id' => $this->id,
            'has_access' => $status['has_access'],
            'active_non_subscription_courses' => $activeNonSubscriptionCourses
        ]);

        return $status;
    }
}
