<?php

namespace App\Jobs;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendExamNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $exam;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Exam $exam)
    {
        $this->user = $user;
        $this->exam = $exam;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::send(
                'emails.exam_notification',
                ['user' => $this->user, 'exam' => $this->exam],
                function ($message) {
                    $message->to($this->user->email, $this->user->name)
                    ->from(config('mail.from.address'), 'Learn Syntax') // Fetch from config
                    ->subject('New Exam Available');
                }
            );
        } catch (\Exception $e) {
            \Log::warning("Failed to send notification to {$this->user->email}: {$e->getMessage()}");
        }
    }
}
