<?php

namespace App\Livewire\Student\Certificate;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class ShowCertificate extends Component
{
    public $selectedCourse = null;
    public $hasAccess = false;
    public $accessStatus = [];
    public $showAccessModal = false;
    
    public function mount()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.login');
        }

        $this->hasAccess = $user->hasAccess();
        $this->accessStatus = $user->getAccessStatus();
        
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
        }
    }
    
    public function selectCourse($courseId)
    {
        $this->selectedCourse = $courseId;
        // This will trigger the confetti and congratulation message
        $this->dispatch('courseSelected');
    }

    public function render()
    {
        if (!$this->hasAccess) {
            return view('livewire.student.certificate.show-certificate', [
                'courses' => collect([]),
                'certificate' => null,
                'hasAccess' => $this->hasAccess,
                'accessStatus' => $this->accessStatus
            ]);
        }

        $courses = Auth::user()
            ->courses()
            ->whereHas('certificates', function($query) {
                $query->where('user_id', Auth::id())
                    ->where('admin_approve', true);
            })
            ->with(['certificates' => function($query) {
                $query->where('user_id', Auth::id())
                    ->where('admin_approve', true);
            }])
            ->get();

        return view('livewire.student.certificate.show-certificate', [
            'courses' => $courses,
            'certificate' => $this->selectedCourse ? 
                $courses->find($this->selectedCourse)->certificates->first() : null,
            'hasAccess' => $this->hasAccess,
            'accessStatus' => $this->accessStatus
        ]);
    }
}
