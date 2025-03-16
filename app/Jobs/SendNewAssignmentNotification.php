<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;

use App\Models\Assignments;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewAssignmentNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student;
    public $assignment;

    /**
     * Create a new job instance.
     */
    // Assignments $assignment , in parameter will pass this
    public function __construct(User $student,Assignments $assignment)
    {
        $this->student = $student;
        $this->assignment = $assignment;
        // dd($assignment->course->title);

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          
        try {
            Mail::send('emails.assignment_notification', 
                ['user'=>$this->student, 'assignment' => $this->assignment],
                function($message){
                    $message->to($this->student->email, $this->student->name)
                    ->subject('New assignment available');
                }
            );
        } catch (\Exception $e) {
            \Log::warning("Failed to send notification to {$this->student->email}: {$e->getMessage()}");
        }
    }
}
