<?php

namespace App\Livewire\Public\Workshops;

use App\Models\Payment;
use App\Models\Workshop as ModelsWorkshop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Workshop extends Component
{

    public $workshops, $user_id, $userPayments;


    public function mount()
    {
        $this->workshops = ModelsWorkshop::get();
        $this->user_id = Auth::id();
        $this->userPayments = Payment::where("student_id", $this->user_id)
            ->where("status", "captured")
            ->pluck('workshop_id')
            ->toArray();

    }
    public function render()
    {
        return view('livewire.public.workshop.workshop');
    }
}
