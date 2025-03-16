<?php

namespace App\Services;

use App\Models\Gem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GemService
{
    public $user_id;
    public $user;

    public function __construct()
    {
        $this->user_id = Auth::id();
        $this->user = User::where('id', $this->user_id)->first();
    }

    public function earnedGem($gem, $description)
    {
        if (!$this->user) {
            throw new \Exception("User not authenticated.");
        }
        Gem::create([
            'user_id' => $this->user_id,
            'amount' => $gem,
            'type' => 'earned',
            'description' => $description,
            'expires_at' => now()->addDays(30),
        ]);

        $this->user->gem += $gem;
        $this->user->save();

        return $this->user->gem;
    }

    public function redeemGem($gem)
    {
        Gem::create([
            'user_id' => $this->user_id,
            'amount' => $gem,
            'type' => 'spent',
            'description' => 'Redeemed Gem',
        ]);
        $this->user->gem -= $gem;
        $this->user->save();

        return $this->user->gem;
    }
}
