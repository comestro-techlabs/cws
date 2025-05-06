<?php

namespace App\Events;

use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentAssignmentNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $assignment_uploaded;
    public $student_id;

    public function __construct(Assignment_upload $assignment_uploaded, User $student_id)
    {
        \Log::info('StudentAssignmentNotification event created for student ID: ' . $student_id);
        $this->assignment_uploaded = $assignment_uploaded;
        $this->student_id = $student_id;
    }

    public function broadcastOn()
    {
        // Use PrivateChannel for security
        return new Channel('assignment-channel');
    }

    public function broadcastAs()
    {
        return 'assignment-uploaded'; 
    }

    public function broadcastWith()
    {
        return [
            'assignment_uploaded' => [
                'id' => $this->assignment_uploaded->id,
                'assignment_id' => $this->assignment_uploaded->assignment_id,
                'assignment_title' => $this->assignment_uploaded->assignment_title
                ?? 'Untitled',
                'file_path' => $this->assignment_uploaded->file_path,
                'submitted_at' => $this->assignment_uploaded->submitted_at?->toIso8601String(),
                'status' => $this->assignment_uploaded->status,
                'student_id' => $this->student_id->id,
                'student_name' => $this->student_id->name ?? 'Unknown',
            ],
        ];
    }
}