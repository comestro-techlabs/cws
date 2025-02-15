<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;

class SendOtpForm extends Component
{
    #[Validate('required|email|exists:users,email')]
    public $email="";

    public function sendotp(){
        $this->validate();

        $email = $this->email;
        $otp = rand(100000, 999999);

        // Find user and update OTP
        $user = User::where('email', $email)->first();
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        try {


            Mail::send('emails.otp', ['otp' => $otp,'user'=>$user], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your OTP For Login');
            });

            // Redirect with success message
            return redirect()->route('auth.login')->with(['otp_sent' => true, 'email' => $email]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send OTP. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.send-otp-form');
    }
}
