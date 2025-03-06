<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\PostCourse;
use Livewire\Component;

class Herosection extends Component
{
    public $courses_title, $courses;
    public function mount()
    {
        $this->courses_title = PostCourse::pluck('title');
        $this->courses = PostCourse::all();
    }
    public function render()
    {
        return <<<'HTML'
            <div>
                
            <div class="bg-white">
                        <div class=" flex items-center justify-center md:pt-12 pt-10 lg:mx-20">
                            <div class=" w-full px-3 pt-5 md:py-0 flex flex-col md:flex-row items-center gap-10">
                                <div class="flex-1 pt-10 lg:py-10 w-full">
                                    <div class="p-8 md:p-10 lg:p-12 text-white">
                                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold leading-tight text-gray-900">
                                            Learn Syntax.<br>Learn <span class="text-primary">Programming</span>
                                        </h1>
                                        <p class="mt-7 text-md md:text-lg text-gray-700 font-sourceSans" >
                                            Transform your passion for coding into a successful career.
                                            Join Learn Syntax, Purnea’s most trusted programming center for hands-on learning,
                                            expert guidance, and real-world projects to unlock your true potential!
                                        </p>
                                        
                                        <div class="mt-10 lg:px-20 mx-auto">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 px-4 md:px-8 justify-center">
                                            @foreach($courses as $course)
                                                <div class="bg-white border border-gray-100 hover:border-blue-500 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden group">
                                                    <a href="{{ route('v2.courses.show', $course->id) }}" wire:navigate class="block h-full">
                                                        <div class="flex items-center p-3">
                                                            <div class="flex-shrink-0">
                                                                <svg wire:ignore width="40" height="40" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform duration-300">
                                                                    <path d="M31.885 16c-8.124 0-7.617 3.523-7.617 3.523l.01 3.65h7.752v1.095H21.197S16 23.678 16 31.876c0 8.196 4.537 7.906 4.537 7.906h2.708v-3.804s-.146-4.537 4.465-4.537h7.688s4.32.07 4.32-4.175v-7.019S40.374 16 31.885 16zm-4.275 2.454c.771 0 1.395.624 1.395 1.395s-.624 1.395-1.395 1.395a1.393 1.393 0 0 1-1.395-1.395c0-.771.624-1.395 1.395-1.395z" fill="url(#a)"/>
                                                                    <path d="M32.115 47.833c8.124 0 7.617-3.523 7.617-3.523l-.01-3.65H31.97v-1.095h10.832S48 40.155 48 31.958c0-8.197-4.537-7.906-4.537-7.906h-2.708v3.803s.146 4.537-4.465 4.537h-7.688s-4.32-.07-4.32 4.175v7.019s-.656 4.247 7.833 4.247zm4.275-2.454a1.393 1.393 0 0 1-1.395-1.395c0-.77.624-1.394 1.395-1.394s1.395.623 1.395 1.394c0 .772-.624 1.395-1.395 1.395z" fill="url(#b)"/>
                                                                    <defs>
                                                                        <linearGradient id="a" x1="19.075" y1="18.782" x2="34.898" y2="34.658" gradientUnits="userSpaceOnUse">
                                                                            <stop stop-color="#387EB8"/>
                                                                            <stop offset="1" stop-color="#366994"/>
                                                                        </linearGradient>
                                                                        <linearGradient id="b" x1="28.809" y1="28.882" x2="45.803" y2="45.163" gradientUnits="userSpaceOnUse">
                                                                            <stop stop-color="#FFE052"/>
                                                                            <stop offset="1" stop-color="#FFC331"/>
                                                                        </linearGradient>
                                                                    </defs>
                                                                </svg>
                                                            </div>
                                                            <div class="ml-3 flex-grow">
                                                                <div class="text-gray-800 font-medium truncate group-hover:text-blue-600 transition-colors duration-300">{{ $course->title }}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="h-1 w-full bg-gradient-to-r from-blue-500 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                                                </div>
                                            @endforeach
                                        </div>
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
