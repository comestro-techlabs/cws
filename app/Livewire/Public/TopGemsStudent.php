<?php

namespace App\Livewire\Public;

use App\Models\User;
use Cache;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TopGemsStudent extends Component
{
    public $topScorers = [];
    public $selectedWeekStart;
    public $weekOptions = [];
    public $weekStart; 
    public $weekEnd;
    public function mount()
    {
        $this->generateWeekOptions();
        $this->selectedWeekStart = Carbon::now()->subWeek()->startOfWeek(Carbon::MONDAY)->toDateString();
        $this->updateWeekRange(); // Initialize week range
        $this->loadTopScorers();
    }

    public function generateWeekOptions()
    {
        $this->weekOptions = [];
        for ($i = 0; $i < 8; $i++) {
            $weekStart = Carbon::now()->subWeeks($i)->startOfWeek(Carbon::MONDAY);
            $weekEnd = $weekStart->copy()->endOfWeek(Carbon::SUNDAY);
            $this->weekOptions[] = [
                'value' => $weekStart->toDateString(),
                'label' => "Week of {$weekStart->format('M d')} - {$weekEnd->format('M d, Y')}",
            ];
        }
    }

    public function updateWeekRange()
    {
        $this->weekStart = Carbon::parse($this->selectedWeekStart)->startOfWeek(Carbon::MONDAY);
        $this->weekEnd = $this->weekStart->copy()->endOfWeek(Carbon::SUNDAY);
    }

    public function loadTopScorers()
    {
        $startOfWeek = Carbon::parse($this->selectedWeekStart)->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $startOfWeek->copy()->endOfWeek(Carbon::SUNDAY);

        $cacheKey = "top_scorers_{$startOfWeek->toDateString()}";
        $this->topScorers = Cache::remember($cacheKey, 3600, function () use ($startOfWeek, $endOfWeek) {
            $currentWeekScorers = User::where('isAdmin', '!=', 1)
                ->where('is_active', true)
                ->where(DB::raw('CAST(gem AS UNSIGNED)'), '>', 0)
                ->where(function ($query) {
                    $query->whereIn('gender', ['male', 'female', 'other', ''])
                        ->orWhereNull('gender');
                })
                ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                ->orderBy(DB::raw('CAST(gem AS UNSIGNED)'), 'desc')
                ->take(10)
                ->get(['id', 'name', 'gem', 'image', 'gender', 'updated_at'])
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'image' => $user->image,
                        'gender' => $user->gender,
                        'gems' => $user->gem,
                    ];
                });

            $prevWeekStart = $startOfWeek->copy()->subWeek();
            $prevWeekEnd = $endOfWeek->copy()->subWeek();
            $prevWeekScorers = User::where('isAdmin', '!=', 1)
                ->where('is_active', true)
                ->where(DB::raw('CAST(gem AS UNSIGNED)'), '>', 0)
                ->whereBetween('updated_at', [$prevWeekStart, $prevWeekEnd])
                ->orderBy(DB::raw('CAST(gem AS UNSIGNED)'), 'desc')
                ->take(10)
                ->pluck('id')
                ->toArray();

            $authUserId = auth()->id();
            $sessionImage = session('user_avatar', auth()->user()->image ?? null);
            $defaultMaleImage = 'https://th.bing.com/th/id/OIP.0IFYK-E_j-bGLz9iSJFR9gHaHa?w=2000&h=2000&rs=1&pid=ImgDetMain';
            $defaultFemaleImage = 'https://www.vhv.rs/dpng/d/426-4264903_user-avatar-png-picture-avatar-profile-dummy-transparent.png';
            $defaultNormalImage = 'https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png';

            return $currentWeekScorers->map(function ($scorer, $index) use ($authUserId, $sessionImage, $defaultMaleImage, $defaultFemaleImage, $defaultNormalImage, $prevWeekScorers) {
                if ($sessionImage && $scorer['id'] === $authUserId) {
                    $scorer['displayImage'] = $sessionImage;
                    \Log::info("Using session image for auth user {$scorer['id']}: $sessionImage");
                } elseif ($scorer['image']) {
                    $scorer['displayImage'] = $scorer['image'];
                    \Log::info("Using DB image for user {$scorer['id']}: {$scorer['image']}");
                } else {
                    $scorer['displayImage'] = match ($scorer['gender']) {
                        'male' => $defaultMaleImage,
                        'female' => $defaultFemaleImage,
                        'other' => $defaultNormalImage,
                        '' => $defaultNormalImage,
                        null => $defaultNormalImage,
                        default => $defaultNormalImage,
                    };
                    \Log::info("Using gender default for user {$scorer['id']}, gender: {$scorer['gender']}, image: {$scorer['displayImage']}");
                }

                $prevRank = array_search($scorer['id'], $prevWeekScorers);
                if ($prevRank === false) {
                    $scorer['trend'] = 'new';
                } elseif ($prevRank > $index) {
                    $scorer['trend'] = 'up';
                } elseif ($prevRank < $index) {
                    $scorer['trend'] = 'down';
                } else {
                    $scorer['trend'] = 'same';
                }

                return $scorer;
            });
        });
    }

    public function updatedSelectedWeekStart()
    {
        $this->updateWeekRange(); 
        $this->loadTopScorers();
    }
    public function render()
    {
        return view('livewire.public.top-gems-student',[
            'topScorers' => $this->topScorers,
            'weekOptions' => $this->weekOptions,
            'selectedWeekStart' => $this->selectedWeekStart,
            'weekStart' => $this->weekStart,
            'weekEnd' => $this->weekEnd,
        ]);
    }
}
