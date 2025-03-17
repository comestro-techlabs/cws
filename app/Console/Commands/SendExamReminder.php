<?php

namespace App\Console\Commands;

use App\Jobs\SendExamNotification;
use App\Jobs\SendNewExamReminder;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendExamReminder extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email reminder to students one day before their exam.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for exams happening tomorrow...');

        $tomorrow = now()->addDay()->toDateString();
        // $tomorrow = now()->toDateString();// For testing ,uncomment and change the exam data as well as to today's date in exam table
        $exams = Exam::whereDate('exam_date', $tomorrow)->get();
    
    foreach ($exams as $exam) {
        $users = User::whereHas('batches', function ($query) use ($exam) {
            $query->where('batch_id', $exam->batch_id);
        })->get();

        foreach ($users as $user) { 
            dispatch(new SendNewExamReminder($user, $exam)); // Dispatch the job
            $this->info("Job dispatched for: " . $user->email);
        }
    }

    $this->info('Exam reminders sent successfully!');

    }
}
