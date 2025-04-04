<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            [
                'user_id' => 1,
                'plan_id' => 1,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addMonth(),
                'status' => 'active',
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'transaction_id' => 'txn_123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'plan_id' => 2,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addMonth(),
                'status' => 'active',
                'payment_status' => 'pending',
                'payment_method' => 'paypal',
                'transaction_id' => 'txn_987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
