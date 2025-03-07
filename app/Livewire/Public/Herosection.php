<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\PostCourse;
use Livewire\Component;

class Herosection extends Component
{
    public $courses_title, $courses;
    public $searchQuery = '';
    
    public function mount()
    {
        $this->courses_title = PostCourse::pluck('title');
        $this->courses = PostCourse::all();
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
                        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                            <!-- Hero Content -->
                            <div class="flex-1 text-center lg:text-left">
                                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                                    Master <span class="text-blue-600">Programming</span><br/>
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                                        For Free
                                    </span>
                                </h1>
                                <p class="mt-6 text-lg sm:text-xl text-gray-600 max-w-2xl">
                                    Start your coding journey today with our comprehensive free courses. 
                                    Learn from industry experts and build real-world projects.
                                </p>
                                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                    <a href="#courses" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out">
                                        Start Learning
                                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#how-it-works" class="inline-flex items-center justify-center px-8 py-3 border-2 border-blue-600 text-base font-medium rounded-lg text-blue-600 bg-transparent hover:bg-blue-50 transition duration-150 ease-in-out">
                                        How It Works
                                    </a>
                                </div>
                                
                                <!-- Stats -->
                                <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-6">
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <div class="text-2xl font-bold text-blue-600">{{ count($courses) }}+</div>
                                        <div class="text-sm text-gray-600">Free Courses</div>
                                    </div>
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <div class="text-2xl font-bold text-blue-600">1000+</div>
                                        <div class="text-sm text-gray-600">Students</div>
                                    </div>
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <div class="text-2xl font-bold text-blue-600">24/7</div>
                                        <div class="text-sm text-gray-600">Support</div>
                                    </div>
                                    <div class="p-4 bg-white rounded-lg shadow-sm">
                                        <div class="text-2xl font-bold text-blue-600">100%</div>
                                        <div class="text-sm text-gray-600">Free</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Cards -->
                            <div class="flex-1 w-full max-w-xl">
                                <div class="bg-white p-6 rounded-2xl shadow-xl">
                                    <div class="mb-6">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Popular Courses</h3>
                                        <div class="relative">
                                            <input 
                                                type="text" 
                                                wire:model.debounce.300ms="searchQuery"
                                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="Search courses..."
                                            >
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                                        @foreach($courses as $course)
                                            <div class="group relative bg-white border border-gray-100 hover:border-blue-500 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                                                <a href="{{ route('v2.courses.show', $course->id) }}" wire:navigate class="block">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-300">
                                                                <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4 flex-1">
                                                            <h4 class="text-lg font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                                                                {{ $course->title }}
                                                            </h4>
                                                            <p class="text-sm text-gray-500">Start learning now</p>
                                                        </div>
                                                        <div class="ml-4">
                                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="absolute bottom-0 left-0 h-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 w-0 group-hover:w-full transition-all duration-300"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
