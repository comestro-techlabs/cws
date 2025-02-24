<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OtpModalForm extends Component
{
    #[Validate('required|email')]
    public $email="";

    #[Validate('required|digits:6')]
    public $otp="";


    public function mount($email)
    {
        $this->email = $email;
    }

    public function verifyotp(){
        // dd($this->email,$this->otp);
        $this->validate();
        $email = $this->email;

        $otp = $this->otp;

        $user = User::where('email', $email)->first();

        if ($user && $user->otp === $otp && Carbon::now()->lessThan($user->otp_expires_at)) {
            Auth::login($user);

            if (!$user->hasVerifiedEmail()) {
                $user->email_verified_at = Carbon::now();
            }

            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            $this->redirect(route('v2.public.homepage'));;
        }

        return redirect()->back()->withInput()->withErrors(['otp' => 'Invalid OTP or OTP has expired.'])->with([
            'otp_sent'=>true,
            'email'=>$email,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.otp-modal-form');
    }
}
