<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Manage Enquiry')] 

class ManageEnquiry extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isEditing = false;
    public $enquiryId;
    public $name;
    public $mobile;
    public $email;
    public $message;
    public $status;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
        'status' => 'required|in:0,1,2', 
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $this->enquiryId = $enquiry->id;
        $this->name = $enquiry->name;
        $this->mobile = $enquiry->mobile;
        $this->email = $enquiry->email;
        $this->message = $enquiry->message;
        $this->status = $enquiry->status;
        $this->isEditing = true;
    }

    public function save()
    {
        $this->validate();

        $enquiry = Enquiry::findOrFail($this->enquiryId);
        $enquiry->update([
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'message' => $this->message,
            'status' => $this->status,
        ]);

        $this->resetForm();
        Session::flash('message', 'Enquiry updated successfully!');
    }

    public function resetForm()
    {
        $this->isEditing = false;
        $this->enquiryId = null;
        $this->name = '';
        $this->mobile = '';
        $this->email = '';
        $this->message = '';
        $this->status = '';
    }

    public function render()
    {
        $enquiries = Enquiry::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.manage-enquiry', [
            'enquiry' => $enquiries
        ]);
    }
}