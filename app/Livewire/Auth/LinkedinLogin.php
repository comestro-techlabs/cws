<?php
namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class LinkedinLogin extends Component
{
    public $errorMessage;

    public function redirectToLinkedin() 
    {
        return redirect()->to(Socialite::driver('linkedin-openid')->redirect()->getTargetUrl());
    }
    
    public function handleLinkedinCallback() 
    {
        try {
            $linkedinUser = Socialite::driver('linkedin-openid')->stateless()->user();
            \Log::info('Linkedin User: ', (array) $linkedinUser);
            $existingUser = User::where('email', $linkedinUser->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $linkedinUser->getName() ?? $linkedinUser->getNickname(), 
                    'email' => $linkedinUser->getEmail(),
                    'image' => $linkedinUser->getAvatar(),
                    'isAdmin' => 0,
                    'linkedin_id' => $linkedinUser->getId(),
                    'password' => bcrypt('123456dummy'),
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended(Auth::user()->isAdmin == 1 ? '/v2/admin/dashboard' : '/');
        } catch (\Exception $e) {
            \Log::error('LinkedIn login error: ' . $e->getMessage());
            $this->errorMessage = 'Unable to login with LinkedIn, please try again.';
            return null; 
        }
    }

    public function render()
    {
        return view('livewire.auth.linkedin-login'); // Adjust view name if needed
    }
}