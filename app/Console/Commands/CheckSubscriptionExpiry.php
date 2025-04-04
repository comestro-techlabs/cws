<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\SubscriptionExpiryNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckSubscriptionExpiry extends Command
{
    protected $signature = 'subscriptions:check-expiry';
    protected $description = 'Check subscription expiry and send notifications';

    public function handle()
    {

        // Get users with active subscriptions
        $users = User::whereHas('currentSubscription')
            ->with('currentSubscription') // Eager load to prevent N+1
            ->chunk(100, function($users) {
                foreach ($users as $user) {
                    $this->processUser($user);
                }
            });

        $this->info('Subscription expiry notifications sent successfully.');
    }

    private function processUser($user)
    {
        $subscription = $user->currentSubscription;
        $daysUntilExpiry = Carbon::now()->diffInDays($subscription->ends_at, false);

        try {
            // Send notification for last 5 days
            if ($daysUntilExpiry <= 5 && $daysUntilExpiry > 0) {
                Mail::to($user->email)
                    ->send(new SubscriptionExpiryNotification($user, $daysUntilExpiry));
            }
            // Send notification when expired (up to 5 days after expiry)
            elseif ($daysUntilExpiry < 0 && $daysUntilExpiry >= -5) {
                Mail::to($user->email)
                    ->send(new SubscriptionExpiryNotification($user, null, true));
            }
        } catch (\Exception $e) {
            $this->error("Failed to send notification to {$user->email}: {$e->getMessage()}");
        }
    }
}
