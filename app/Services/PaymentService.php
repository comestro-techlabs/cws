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
        //  $today = Carbon::parse("2025-09-15 00:00:00");
         $today = Carbon::now();

         // Fetch all students who have unpaid or overdue payments
         $students = Payment::whereIn('status', ['unpaid', 'overdue'])
             ->pluck('student_id')
             ->unique();

         foreach ($students as $studentId) {
             // Check if the student has any existing overdue payments
             $existingOverdue = Payment::where('student_id', $studentId)
                 ->where('status', 'overdue')
                 ->where('days_overdue', '>=', 15)
                 ->exists();

             if ($existingOverdue) {
                 continue; // Skip if the student already has an overdue payment
             }

             // Get the last PAID payment record
             $lastPaidPayment = Payment::where('student_id', $studentId)
                 ->whereIn('status', ['paid', 'captured'])
                 ->orderBy('due_date', 'desc')
                 ->first();



             if (!$lastPaidPayment) {
                 continue; // Skip if no previous paid record exists
             }

             $lastPaidDate = Carbon::parse($lastPaidPayment->due_date);

             // Get the NEXT unpaid payment after the last paid date
             $nextUnpaidPayment = Payment::where('student_id', $studentId)
             ->whereIn('status', ['unpaid',"overdue"])
             ->whereDate('due_date', '>', $lastPaidDate) // Payments after the last paid month
             ->whereDate('due_date', '<', $today) // Only overdue payments
             ->orderBy('due_date', 'asc') // Get the oldest unpaid payment
             ->first();

            //  dd($nextUnpaidPayment);

             if ($nextUnpaidPayment) {
                 $dueDate = Carbon::parse($nextUnpaidPayment->due_date);
                 $daysOverdue = $dueDate->diffInDays($today);

                 // **Check if the student is resuming after months of non-payment**
                 $previousOverduePaid = Payment::where('student_id', $studentId)
                     ->where('status', 'paid')
                     ->whereDate('due_date', '<', $nextUnpaidPayment->due_date)
                     ->exists();

                //  dd($nextUnpaidPayment->due_date);

                 if ($previousOverduePaid) {
                     // If the student had an overdue payment but has now paid it, restart fresh (no late fee)
                     continue;
                 }

                //  dd($daysOverdue);
                 if ($daysOverdue) { // Only mark overdue if past 15 days
                     $daysOverdue = min($daysOverdue, 15); // Cap at 15 days
                     $lateFee = $daysOverdue * 10; // Calculate late fee

                     // Update only this one overdue payment
                     $nextUnpaidPayment->update([
                         'status' => 'overdue',
                         'days_overdue' => $daysOverdue,
                         'late_fee' => $lateFee,
                         'total_amount' => $nextUnpaidPayment->amount + $lateFee,
                     ]);
                 }
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
