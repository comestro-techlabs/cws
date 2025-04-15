<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\PostCourse;
use Livewire\Component;


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

    }

    public function render()
    {
        return <<<'HTML'
            <div class="relative mt-10 md:mt-5 bg-gradient-to-br from-purple-50 via-white to-purple-100">
              
                
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
                    <div class="grid ">
                       
                        <div class="lg:col-span-3">
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
                </div>
            </div>
        HTML;
    }
}