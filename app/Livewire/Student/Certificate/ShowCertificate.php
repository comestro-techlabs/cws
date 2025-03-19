<?php

namespace App\Livewire\Student\Certificate;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class ShowCertificate extends Component
{
    public $selectedCourse = null;
    
    public function selectCourse($courseId)
    {
        $this->selectedCourse = $courseId;
    }

    public function render()
    {
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
                $courses->find($this->selectedCourse)->certificates->first() : null
        ]);
    }
}
