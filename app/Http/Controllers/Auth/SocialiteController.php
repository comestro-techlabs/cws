<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $findUser = User::where('email', $user->getEmail())->first();

        if($findUser){
            Auth::login($findUser);
        }else{
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'google_id'=> $user->getId(),
                'password' => encrypt('123456dummy') // You can choose to use a dummy password.
            ]);

            Auth::login($newUser);
        }

        return redirect()->intended('dashboard'); // Adjust the redirect as per your application's need
    }

}
