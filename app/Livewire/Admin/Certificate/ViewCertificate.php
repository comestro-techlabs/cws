<?php

namespace App\Livewire\Admin\Certificate;

use Livewire\Component;
use App\Models\Certificate;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ViewCertificate extends Component
{
    public $certificate;
    public $certificateId;

    public function mount($certificateId)
    {
        $this->certificateId = $certificateId;
        $this->certificate = Certificate::with(['user', 'course'])->findOrFail($certificateId);
    }

    public function approveCertificate()
    {
        $this->certificate->update([
            'admin_approve' => true
        ]);
        $this->certificate->refresh();
    }

    public function render()
    {
        return view('livewire.admin.certificate.view-certificate')->layout(null);
    }
}
