<?php

namespace App\Livewire\Auth;

use App\Mail\UserRegisterMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class GoogleLogin extends Component
{
    public $errorMessage = '';

    // Method to initiate Google login
    public function redirectToGoogle()
    {
        try {
            $parameters = [
                'client_id' => config('services.google.client_id'),
                'redirect_uri' => url(config('services.google.redirect')),
                'response_type' => 'code',
                'scope' => 'openid profile email',
                'access_type' => 'online',
            ];

            return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($parameters));
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to connect to Google. Please try again.');
            return null;
        }
    }

    // This will be called after the callback in a view or route
    public function handleGoogleCallback()
    {
        try {
            // Get user data from Google
            $googleUser = Socialite::driver('googleAuth')->stateless()->user();

            if (!$googleUser || !$googleUser->getEmail()) {
                throw new \Exception('Failed to get user data from Google');
            }

            // Find or create user
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName() ?? explode('@', $googleUser->getEmail())[0],
                    'google_id' => $googleUser->getId(),
                    'image' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(24)),
                    'email_verified_at' => now(),
                ]
            );

            // Login user
            Auth::login($user, true);

            // Store avatar in session
            session()->put('user_avatar', $googleUser->getAvatar());

            // Determine redirect path
            $redirectPath = $user->isAdmin ? '/v2/admin/dashboard' : '/student/dashboard';

            return redirect()->to($redirectPath);

        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());

            session()->flash('error', 'Google authentication failed. Please try again.');

            return redirect()->route('auth.login');
        }
    }

    public function render()
    {
        return view('livewire.auth.google-login');
    }
}
