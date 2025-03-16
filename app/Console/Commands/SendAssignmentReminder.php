<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Assignments;
use App\Models\User;

class SendAssignmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assignment:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an assignment reminder to students one day before their exam.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for exams happening tomorrow...');
        $tomorrow = now()->addDay()->toDateString();
        // $tomorrow = now()->toDateString();// For testing ,uncomment and change the exam data as well to today's date in exam table
        $assignments = Assignments::whereDate('due_date', $tomorrow)->get();
        foreach ($assignments as $assignment) {
            $users = User::whereHas('courses', function ($query) use ($assignment) {
                $query->where('course_id', $assignment->course_id);
            })->get();
            foreach ($users as $user) {
                dispatch(new SendAssignmentReminder($user, $assignment)); // Dispatch the job
                $this->info("Job dispatched for: " . $user->email);
            }
        }
        $this->info('Assignment reminders sent successfully!');
    }
}
