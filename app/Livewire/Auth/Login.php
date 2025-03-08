<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate('required|email|exists:users,email')]
    public $email = "";

    #[Validate('required|digits:6')]
    public $otp = "";

    public $isSendOtp = false;

    public function save()
    {
        $this->validate(['email' => 'required|email|exists:users,email']);

        $email = $this->email;
        $otp = rand(100000, 999999);

        // Find user and update OTP
        $user = User::where('email', $email)->first();
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        try {
            // Send OTP email with correct template and data
            $data = ['user' => $user, 'otp' => $otp];
            Mail::send('emails.otp', $data, function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your Login OTP Code');
            });

            $this->isSendOtp = true;

            // Flash success message without redirect
            session()->flash('success', 'OTP sent to your email.');

            // Dispatch event to trigger UI update
            $this->dispatch('otp-sent')->self();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function verifyotp()
    {
        $this->validate(['otp' => 'required|digits:6']);

        $user = User::where('email', $this->email)->first();

        if ($user && $user->otp === $this->otp && Carbon::now()->lessThan($user->otp_expires_at)) {
            Auth::login($user);

            if (!$user->hasVerifiedEmail()) {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }

            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // Redirect to student dashboard
            return $this->redirectRoute('v2.student.dashboard');
        }

        // Show error without page refresh
        $this->addError('otp', 'Invalid OTP or OTP has expired.');
    }

    public function resendOtp()
    {
        $this->sendotp();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
