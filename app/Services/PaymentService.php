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
    $today = Carbon::parse("2025-12-30 00:00:00");

    // Fetch all students who have unpaid or overdue payments
    $students = Payment::whereIn('status', ['unpaid', 'overdue'])
        ->pluck('student_id')
        ->unique();

    foreach ($students as $studentId) {
        // Get the last paid record for the student
        $lastPaidPayment = Payment::where('student_id', $studentId)
            ->whereIn('status', ['paid', 'captured']) // Consider 'paid' or 'captured' as completed payments
            ->orderBy('due_date', 'desc')
            ->first();

        if (!$lastPaidPayment) {
            continue; // Skip if no previous paid record exists
        }

        $lastPaidDate = Carbon::parse($lastPaidPayment->due_date);

        // Fetch only unpaid payments that are AFTER the last paid date
        $overduePayments = Payment::where('student_id', $studentId)
            ->whereIn('status', ['unpaid', 'overdue'])
            ->whereDate('due_date', '>', $lastPaidDate) // Payments after the last paid month
            ->whereDate('due_date', '<', $today) // Only overdue payments
            ->get();

        foreach ($overduePayments as $payment) {
            $dueDate = Carbon::parse($payment->due_date);
            $daysOverdue = $dueDate->diffInDays($today);
            $daysOverdue = min($daysOverdue, 15); // Cap overdue days at 15

            // Calculate late fee (₹10 per day)
            $lateFee = $daysOverdue * 10;

            // Update payment record
            $payment->update([
                'status' => 'overdue',
                'days_overdue' => $daysOverdue,
                'late_fee' => $lateFee,
                'total_amount' => $payment->amount + $lateFee,
            ]);
        }
    }

    return "Overdue payments processed successfully.";
}

    // public function processOverduePayments()
    // {
    //     $today = Carbon::parse("2025-04-03 00:00:00");
    //     // $today = Carbon::today();
    //     // Fetch all unpaid payments with due dates in the past
    //     $overduePayments = Payment::whereIn('status', ['unpaid', 'overdue'])
    //         ->whereDate('due_date', '<', $today)
    //         ->get();

    //     foreach ($overduePayments as $payment) {
    //         $dueDate = Carbon::parse($payment->due_date);
    //         $daysOverdue = $dueDate->diffInDays($today);
    //         // Cap overdue days at 15
    //         $daysOverdue = min($daysOverdue, 15);


    //         // dd($daysOverdue);

    //         // Calculate late fee (example: ₹10 per day)
    //         $lateFee = $daysOverdue * 10;

    //         // Update payment record
    //         $payment->update([
    //             'status' => 'overdue',
    //             'days_overdue' => $daysOverdue,
    //             'late_fee' => $lateFee,
    //             'total_amount' => $payment->amount + $lateFee,
    //         ]);

    //         if($daysOverdue > 0){
    //             break;
    //         }
    //     }

    //     return $overduePayments->count();
    // }
}
