<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use Carbon\Carbon;

class ProcessOverduePayments extends Command
{
    protected $signature = 'payments:process-overdue';
    protected $description = 'Update overdue payments with late fees and status';

    public function handle()
    {
        $today = Carbon::today();

        // Get all unpaid payments with due date in the past
        $overduePayments = Payment::whereIn('status', ['unpaid', 'overdue'])
            ->whereDate('due_date', '<', $today)
            ->get();

        foreach ($overduePayments as $payment) {
            $dueDate = Carbon::parse($payment->due_date);
            $daysOverdue = $dueDate->diffInDays($today);

            // Cap overdue days at 15
            $daysOverdue = min($daysOverdue, 15);

            // Calculate late fee (example: ₹10 per day)
            $lateFee = $daysOverdue * 10;

            // Update payment record
            $payment->update([
                'status' => 'overdue',
                'days_overdue' => $daysOverdue,
                'late_fee' => $lateFee,
                'total_amount' => $payment->amount + $lateFee,
            ]);
        }

        $this->info('Processed '.$overduePayments->count().' overdue payments');
    }
}
