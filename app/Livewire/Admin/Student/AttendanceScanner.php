<?php

namespace App\Livewire\Admin\Student;
use App\Models\Attendance;
use Carbon\Carbon;
use Livewire\Component;

class AttendanceScanner extends Component
{
    public $barcode;

    public function scanBarcode()
    {
        $attendance = Attendance::where('barcode_id', $this->barcode)->first();

        if ($attendance) {
            if (!$attendance->check_in) {
                $attendance->update(['check_in' => Carbon::now()]);
                session()->flash('message', 'Check-in successful!');
            } elseif (!$attendance->check_out) {
                $attendance->update(['check_out' => Carbon::now()]);
                session()->flash('message', 'Check-out successful!');
            } else {
                session()->flash('message', 'Already checked out!');
            }
        } else {
            session()->flash('error', 'Invalid Barcode!');
        }

        $this->barcode = ''; // Reset input
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-scanner');
    }
}
