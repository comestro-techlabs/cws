<?php
namespace App\Livewire\Admin\Message;


use App\Models\Batch;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Insert Message')]

class CreateMessage extends Component
{
    public $title = '';
    public $content = '';
    public $recipient_type = 'all_users';
    public $batch_id = '';
    public $some_user_ids = [];
    public $user_id = '';
    
    public $batches;
    public $users;
    
    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'recipient_type' => 'required|in:all_users,batch,single_user,some_users',
        'batch_id' => 'required_if:recipient_type,batch|nullable|exists:batches,id',
        'some_user_ids' => 'required_if:recipient_type,some_users|array|nullable',
        'some_user_ids.*' => 'exists:users,id',
        'user_id' => 'required_if:recipient_type,single_user|nullable|exists:users,id',
    ];

    public function mount()
    {
        $this->batches = Batch::with('course')->get();
        $this->users = User::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validated = $this->validate();

        $recipients = [];

        switch ($this->recipient_type) {
            case 'all_users':
                $recipients = User::pluck('id')->map(fn($id) => (int) $id)->toArray();
                break;
            case 'batch':
                if ($this->batch_id) {
                    $batch = Batch::find($this->batch_id);
                    if ($batch) {
                        $recipients = $batch->users->pluck('id')->map(fn($id) => (int) $id)->toArray();
                    }
                }
                break;
            case 'single_user':
                if ($this->user_id) {
                    $recipients = [(int) $this->user_id];
                }
                break;
            case 'some_users':
                if (!empty($this->some_user_ids)) {
                    $recipients = array_unique(array_map('intval', $this->some_user_ids));
                }
                break;
        }

        Message::create([
            'title' => $this->title,
            'content' => $this->content,
            'recipient_type' => $this->recipient_type,
            'recipients' => $recipients,
        ]);

        $this->reset(['title', 'content', 'recipient_type', 'batch_id', 'some_user_ids', 'user_id']);
        $this->dispatch('notice', type: 'info', text: 'Message Created Successfully!');    }

    public function render()
    {
        return view('livewire.admin.message.create-message');
    }
}