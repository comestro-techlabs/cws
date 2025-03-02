<?php
namespace App\Livewire\Student;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Message;

class MessageView extends Component
{
    public $message;

    public function mount(Message $message)
    {
        $student = auth()->user();
        if (!in_array($student->id, $message->recipients ?? [])) {
            abort(403, 'Unauthorized');
        }

        $readMessages = session('read_messages', []);
        if (!in_array($message->id, $readMessages)) {
            $readMessages[] = $message->id;
            session(['read_messages' => $readMessages]);
        }

        $this->message = $message;
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.message-view');
    }
}