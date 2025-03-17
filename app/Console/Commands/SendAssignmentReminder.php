<?php

namespace App\Console\Commands;

use App\Jobs\SendNewAssignmentNotification;
use App\Jobs\SendNewAssignmentReminder;
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
        $this->info('Checking for assignments happening tomorrow...');
        // $tomorrow = now()->addDay()->toDateString();
        $tomorrow = now()->toDateString();// For testing ,uncomment and change the exam data as well to today's date in exam table
        $assignments = Assignments::whereDate('due_date', $tomorrow)->get();
        foreach ($assignments as $assignment) {
            // $this->info("testing: " . $assignment->course_id);
            $users = User::whereHas('courses', function ($query) use ($assignment) {
                $query->where('course_id', $assignment->course_id);
            })->get();
            // $this->info("Job dispatched for: " . $users);


            foreach ($users as $user) {
               
                dispatch(new SendNewAssignmentReminder($user, $assignment)); // Dispatch the job
                // $this->info("Job dispatched for: " . $user->email);

            }
        }
        // $this->info('Assignment reminders sent successfully!');
    }
}
