<?php

namespace App\Services;

use App\Models\Payment;
use Carbon\Carbon;

class PaymentService
{
    /**
     * Process overdue payments and apply late fees.
     *
     * @return int Number of processed overdue payments.
     */
    public function processOverduePayments()
    {
        // $today = Carbon::parse("2025-04-03 00:00:00");
        $today = Carbon::today();
        // Fetch all unpaid payments with due dates in the past
        $overduePayments = Payment::whereIn('status', ['unpaid', 'overdue'])
            ->whereDate('due_date', '<', $today)
            ->get();

        foreach ($overduePayments as $payment) {
            $dueDate = Carbon::parse($payment->due_date);
            $daysOverdue = $dueDate->diffInDays($today);
            // Cap overdue days at 15
            $daysOverdue = min($daysOverdue, 15);

            // dd($daysOverdue);

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

        return $overduePayments->count();
    }
}
