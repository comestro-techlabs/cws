<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Herosection extends Component
{
    public function render()
    {
        return <<<'HTML'
            <div>
            <div class="bg-gradient-to-r to-purple-100 via-purple-300 from-purple-50">
                    <nav id="navbar" class="sticky top-4 lg:max-w-7xl md:max-w-3xl sm:max-w-xl mx-auto  bottom-auto z-40 w-full transition-all duration-300 rounded-xl px-4">
                        <livewire:public.header />
                    </nav>

                    <!-- Content Section -->
                    <div class="relative md:pt-[30px] overflow-hidden">
                        <div class="absolute inset-0">
                            <svg class="w-full h-full" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#4f46e5" fill-opacity="0.3" d="M0,256L48,245.3C96,235,192,213,288,218.7C384,224,480,256,576,245.3C672,235,768,181,864,144C960,107,1056,85,1152,101.3C1248,117,1344,171,1392,197.3L1440,224L1440,320L0,320Z"></path>
                            </svg>
                        </div>

                        <div class="relative flex items-center justify-center md:pt-12 pt-10 lg:mx-20">
                            <div class="relative z-10 w-full px-3 pt-5 md:py-0 flex flex-col md:flex-row items-center gap-10">
                                
                                <div class="flex-1 pt-10 lg:py-10 w-full lg:w-1/2">
                                    <div class="p-8 md:p-10 lg:p-12 text-white">
                                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900">
                                            Learn Syntax.<br>Learn <span class="text-primary">Programming</span>
                                        </h1>
                                        <p class="mt-7 text-md md:text-lg text-gray-700">
                                            Transform your passion for coding into a successful career.
                                            Join Learn Syntax, Purnea’s most trusted programming center for hands-on learning,
                                            expert guidance, and real-world projects to unlock your true potential!
                                        </p>
                                        <div class="mt-10">
                                            <a href="#courses" class="px-6 py-3 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                Explore Courses
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full lg:w-1/2 hidden md:flex ">
                                    <img src="{{ asset('hero-bg.png') }}" class="w-[98%] lg:w-[98%] h-[400px] md:h-[450px] lg:h-[500px] object-cover rounded-lg shadow-2xl flex justify-start items-center">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        HTML;
    }
}
