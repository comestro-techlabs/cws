<?php
namespace App\Livewire\Admin\Message;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Insert Message')]


class ManageMessage extends Component
{
    public $messages;
    public $selectedMessage = null;
    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::all();
    }

    public function deleteMessage($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->delete();
        
        $this->loadMessages(); 
        $this->selectedMessage = null;
        session()->flash('success', 'Message Deleted Successfully');
    }
    public function render()
    {
        return view('livewire.admin.message.manage-message');
    }
    
}