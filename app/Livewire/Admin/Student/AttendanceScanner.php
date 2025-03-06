<?php

namespace App\Livewire\Admin\Student;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Attendance Students')]
class AttendanceScanner extends Component
{
    public $barcode;
    public $student; // Holds student details
    public $message;

    public function scanBarcode()
    {
        $this->message = null;
        $this->student = null;

        // Find user by barcode
        $user = User::where('barcode', $this->barcode)->first();

        if ($user) {
            // Check if already checked in today
            $alreadyCheckedIn = Attendance::where('user_id', $user->id)
                ->whereDate('check_in', Carbon::today())
                ->exists();

            if (!$alreadyCheckedIn) {
                Attendance::create([
                    'user_id' => $user->id,
                    'check_in' => Carbon::now(),
                ]);
                $this->message = 'Check-in successful!';
            } else {
                $this->message = 'Already checked in today!';
            }

            // Store student details
            $this->student = $user;
        } else {
            $this->message = 'Invalid Barcode!';
        }

        $this->barcode = ''; // Reset input field
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-scanner');
    }
}
