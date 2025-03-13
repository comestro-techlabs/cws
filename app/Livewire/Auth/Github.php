<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class Github extends Component
{
    public $errorMessage; 

    public function redirectToGithub() 
    {
        return redirect()->to(Socialite::driver('github')->redirect()->getTargetUrl());
    }
    
    public function handleGithubCallback() 
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();
            \Log::info('GitHub User: ', (array) $githubUser);

            $existingUser = User::where('email', $githubUser->getEmail())->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(), 
                    'email' => $githubUser->getEmail(),
                    'image' => $githubUser->getAvatar(),
                    'isAdmin' => 0,
                    'github_id' => $githubUser->getId(),
                    'password' => bcrypt('123456dummy'),
                ]);
                Auth::login($newUser);
            }

            return redirect()->intended(
                Auth::user()->isAdmin ? '/admin/dashboard' : '/'
            );
        } catch (\Exception $e) {
            \Log::error('GitHub login error: ' . $e->getMessage());
            $this->errorMessage = 'Unable to login with GitHub, please try again.';
            return null; 
        }
    }

    public function render()
    {
        return view('livewire.auth.github');
    }
}