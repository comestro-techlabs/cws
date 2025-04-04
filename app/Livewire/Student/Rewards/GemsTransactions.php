<?php

namespace App\Livewire\Student\Rewards;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GemTransaction;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class GemsTransactions extends Component
{
    use WithPagination; 

    public function render()
    {
        $userId = auth()->id();

        return view('livewire.student.rewards.gems-transactions', [
            'totalGems' => auth()->user()->gems,
            'earnedThisMonth' => GemTransaction::where('user_id', $userId)
                ->where('type', 'earned')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'spentThisMonth' => GemTransaction::where('user_id', $userId)
                ->where('type', 'spent')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'lifetimeEarned' => GemTransaction::where('user_id', $userId)
                ->where('type', 'earned')
                ->sum('amount'),
            'expiringSoon' => GemTransaction::where('user_id', $userId)
                ->where('expires_at', '>', now())
                ->where('expires_at', '<=', now()->addDays(30))
                ->sum('amount'),
            'transactions' => GemTransaction::where('user_id', $userId)
                ->latest()
                ->paginate(10)
        ]);
    }
}
