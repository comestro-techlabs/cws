<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class Facebook extends Component
{
    public $errorMessage; 

    public function redirectToFacebook() 
    {
        return redirect()->to(Socialite::driver('facebook')->redirect()->getTargetUrl());
    }
    
    public function handleFacebookCallback() 
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
            \Log::info('facebook User: ', (array) $facebookUser);

            $existingUser = User::where('email', $facebookUser->getEmail())->first();
            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $facebookUser->getName() ?? $facebookUser->getNickname(), 
                    'email' => $facebookUser->getEmail(),
                    'image' => $facebookUser->getAvatar(),
                    'isAdmin' => 0,
                    'facebook_id' => $facebookUser->getId(),
                    'password' => bcrypt('123456dummy'),
                ]);

                Auth::login($newUser);
            }

            return redirect()->intended(Auth::user()->isAdmin == 1 ? '/v2/admin/dashboard' : '/');
        } catch (\Exception $e) {
            \Log::error('facebook login error: ' . $e->getMessage());
            $this->errorMessage = 'Unable to login with facebook, please try again.';
            return null; 
        }
    }

    public function render()
    {
        return view('livewire.auth.facebook');
    }
}
