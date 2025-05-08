<?php

namespace App\Events;

use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentAssignmentNotification implements ShouldBroadcast
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
        \Log::info('Broadcasting on assignment channel for student ID: ' . $this->student_id->id);
        return new Channel('assignment-channel');
    }

    public function broadcastAs()
    {
        \Log::info('Broadcasting as assignment-uploaded for student ID: ' . $this->student_id->id);
        return 'assignment-uploaded';
    }

    public function broadcastWith()
    {
        $assignment = Assignments::find($this->assignment_uploaded->assignment_id);
        \Log::info('Broadcasting assignment data:', [
            'assignment_id' => $this->assignment_uploaded->assignment_id,
            'assignment_title' => $assignment->title ?? 'Untitled',
        ]);

        return [
            'assignment_uploaded' => [
                'id' => $this->assignment_uploaded->id,
                'assignment_id' => $this->assignment_uploaded->assignment_id,
                'assignment_title' => $assignment->title ?? 'Untitled',
                'file_path' => $this->assignment_uploaded->file_path,
                'submitted_at' => $this->assignment_uploaded->submitted_at?->toIso8601String(),
                'status' => $this->assignment_uploaded->status,
                'student_id' => $this->student_id->id,
                'student_name' => $this->student_id->name ?? 'Unknown',
            ],
        ];
    }
}