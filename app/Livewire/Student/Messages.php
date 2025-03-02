<?php

namespace App\Livewire\Student;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Message; 

class Messages extends Component
{
    public $sortmessages; 
    public $readMessages; 
    public $unreadCount;

    public function mount() 
    {
        $student = auth()->user();
        
        $messages = Message::whereJsonContains('recipients', $student->id)->get();
        
        $this->readMessages = session('read_messages', []);
        
        $this->sortmessages = $messages->sortBy(function ($message) {
            return in_array($message->id, $this->readMessages) ? 1 : 0;
        });
        
        $this->unreadCount = $this->sortmessages->whereNotIn('id', $this->readMessages)->count();
    }
    #[Layout('components.layouts.student')]

    public function render()
    {
        return view('livewire.student.message')
            ->with([
                'sortmessages' => $this->sortmessages,
                'readMessages' => $this->readMessages,
                'unreadCount' => $this->unreadCount,
            ]);
    }
}