<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_in_days',
        'is_active',
        'features'
    ];
    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    // Add accessor to ensure features is always an array
    public function getFeaturesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }
}
