<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'slug' => 'basic',
                'price' => 699,
                'duration_in_days' => 30,
                'features' => json_encode(['All Basic Features', 'Full Course Access', 'Basic Support']),
                'is_active' => true
            ],
            [
                'name' => 'Pro Plan',
                'slug' => 'pro',
                'price' => 1499,
                'duration_in_days' => 90,
                'features' => json_encode(['All Basic Features', 'Priority Support', 'Advanced Features']),
                'is_active' => true
            ],
            [
                'name' => 'Premium Plan',
                'slug' => 'premium',
                'price' => 4999,
                'duration_in_days' => 365,
                'features' => json_encode(['All Pro Features', '24/7 Support', 'Exclusive Content']),
                'is_active' => true
            ]
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
}
