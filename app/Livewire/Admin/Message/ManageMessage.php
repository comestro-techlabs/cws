<?php
namespace App\Livewire\Admin\Message;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Insert Message')]
class ManageMessage extends Component
{
    use WithPagination;
    
    public $selectedMessage = null;
    public $perPage = 10;
    
    public function deleteMessage($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->delete();
        
        $this->selectedMessage = null;
        $this->dispatch('notice', type: 'info', text: 'Message Deleted Successfully!');
        $this->resetPage(); // Reset pagination after deletion
    }

    public function render()
    {
        return view('livewire.admin.message.manage-message', [
            'messages' => Message::paginate($this->perPage)
        ]);
    }
}