<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\PostCourse;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Herosection extends Component
{
    public $courses_title, $courses, $articles;
    public $searchQuery = '';
    public $topScorers = [];
    public $selectedWeekStart;
    public $weekOptions = [];
    public $weekStart; // Added as public property
    public $weekEnd;   // Added as public property

    public function mount()
    {
        $this->courses_title = PostCourse::pluck('title');
        $this->courses = Course::where('published', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        $this->articles = PostCourse::where('status', true)
            ->latest()
            ->take(3)
            ->get();

        // Generate week options (last 8 weeks)
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
        $this->updateWeekRange(); // Update week range when selection changes
        $this->loadTopScorers();
    }

    public function render()
    {
        // No need to redefine $weekStart and $weekEnd here since they're public properties
        return <<<'HTML'
            <div class="relative mt-10 md:mt-5 bg-gradient-to-br from-purple-50 via-white to-purple-100">
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 via-white to-purple-100"></div>
                </div>
                
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32">
                    <!-- Hero Header -->
                    <div class="text-center mb-16">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900">
                            Choose Your <span class="text-[#662d91]">Learning Path</span>
                        </h1>
                        <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
                            Flexible learning options to fit your schedule - attend classes at our center, 
                            learn online, or access free programming articles
                        </p>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                        <!-- Left Section (3 columns) -->
                        <div class="lg:col-span-3">
                            <!-- Learning Paths Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                                <div class="relative group bg-white p-6 rounded-2xl shadow-sm transition-all duration-300 hover:shadow">
                                    <div class="absolute inset-0 bg-gradient-to-r from-purple-50 to-purple-100 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="relative">
                                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                                            <svg class="w-6 h-6 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">Center-based Learning</h3>
                                        <p class="text-gray-600 mb-4">Join our state-of-the-art facility for in-person classes with expert instructors</p>
                                        <a href="#offline-courses" class="inline-flex items-center text-[#662d91] font-medium">
                                            View Schedule
                                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="relative group bg-white p-6 rounded-2xl shadow-sm transition-all duration-300 hover:shadow">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="relative">
                                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                                            <svg class="w-6 h-6 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">Live Online Classes</h3>
                                        <p class="text-gray-600 mb-4">Interactive virtual sessions with real-time instructor support</p>
                                        <a href="#online-courses" class="inline-flex items-center text-[#662d91] font-medium">
                                            Browse Courses
                                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="relative group bg-white p-6 rounded-2xl shadow-sm transition-all duration-300 hover:shadow">
                                    <div class="absolute inset-0 bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="relative">
                                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                            <svg class="w-6 h-6 text-[#662d91]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">Free Learning Resources</h3>
                                        <p class="text-gray-600 mb-4">Access our library of programming articles and tutorials</p>
                                        <a href="#articles" class="inline-flex items-center text-[#662d91] font-medium">
                                            Read Articles
                                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Latest Articles Preview -->
                            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-sm p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900">Latest Articles</h2>
                                    <a href="#all-articles" class="text-[#662d91] hover:text-purple-700">View All</a>
                                </div>
                                <div class="grid gap-6 md:grid-cols-3">
                                    @foreach($articles as $article)
                                    <div class="group relative bg-white rounded-xl border border-gray-100 transition-all duration-300 hover:shadow-sm">
                                        <div class="p-6">
                                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-[#662d91] transition-colors">
                                                {{ $article->title }}
                                            </h3>
                                            <p class="mt-2 text-gray-600 text-sm">
                                                {{ Str::limit($article->description, 100) }}
                                            </p>
                                            <a href="{{ route('v2.courses.show', $article->id) }}" class="mt-4 inline-flex items-center text-sm text-[#662d91]">
                                                Read More
                                                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Right Section (1 column) - Top Scorers -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden sticky top-20">
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between mb-4">
                                        <h2 class="text-lg font-semibold text-gray-900">Weekly Top Scorers</h2>
                                        <span class="text-sm text-gray-500">Gems</span>
                                    </div>
                                    <select wire:model.live="selectedWeekStart" class="w-full p-2 mb-4 border rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                                    @foreach(array_slice($weekOptions, 0, 3) as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                    @endforeach

                                    </select>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Showing results for {{ $this->weekStart->format('M d') }} - {{ $this->weekEnd->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="px-6 py-4">
                                    @if($topScorers->isEmpty())
                                        <p>No top scorers for this week (based on activity).</p>
                                    @else
                                        <ul class="space-y-4">
                                            @foreach($topScorers as $index => $scorer)
                                                <li class="flex items-center">
                                                    <span class="w-6 h-6 flex items-center justify-center rounded-full bg-purple-100 text-purple-800 font-semibold mr-3">
                                                        {{ $index + 1 }}
                                                    </span>
                                                    <div class="w-10 h-10 rounded-full overflow-hidden">
                                                        <img class="w-full h-full object-cover ring-2 ring-purple-600 ring-offset-2"
                                                            src="{{ $scorer['displayImage'] ?? 'https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png' }}"
                                                            alt="{{ $scorer['name'] }}'s Profile" loading="lazy"
                                                            onerror="this.src='https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png'" />
                                                    </div>
                                                    <div class="ml-3 flex-1">
                                                        <span class="text-sm text-gray-900 font-medium">{{ $scorer['name'] }}</span>
                                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                                            
                                                            <span class="flex items-center gap-1">
                                                                @if($scorer['trend'] === 'up')
                                                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M10 3l-7 7h4v7h6v-7h4l-7-7z"/>
                                                                    </svg>
                                                                @elseif($scorer['trend'] === 'down')
                                                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M10 17l7-7h-4V3H7v7H3l7 7z"/>
                                                                    </svg>
                                                                @elseif($scorer['trend'] === 'new')
                                                                    <span class="text-blue-500 text-xs font-semibold">New</span>
                                                                @else
                                                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M5 10h10v2H5v-2z"/>
                                                                    </svg>
                                                                @endif
                                                            </span>
                                                            <span class="flex items-center gap-1">
                                                                {{ $scorer['gems'] }}
                                                                <svg class="w-4 h-4" viewBox="0 0 24 24">
                                                                    <defs>
                                                                        <linearGradient id="gemGradient_{{ $index }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                                                            <stop offset="0%" style="stop-color:#60A5FA" />
                                                                            <stop offset="50%" style="stop-color:#8B5CF6" />
                                                                            <stop offset="100%" style="stop-color:#EC4899" />
                                                                        </linearGradient>
                                                                    </defs>
                                                                    <path fill="url(#gemGradient_{{ $index }})" d="M12 1L3 9l9 13l9-13l-9-8zm0 3.5L6.5 9h11L12 4.5zM5 10l7 10l7-10H5z" />
                                                                    <path fill="currentColor" opacity="0.2" d="M12 14L5 10h14l-7 4z" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}