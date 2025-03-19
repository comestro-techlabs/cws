<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

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
        return $subscription && $subscription->status === 'active' 
            && $subscription->payment_status === 'completed'
            && $subscription->ends_at > now();
    }

    public function exams()
    {
        return $this->hasMany(ExamUser::class, 'user_id');
    }
}
