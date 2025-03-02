<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Herosection extends Component
{
    public function render()
    {
        return <<<'HTML'
            <div>
            <div class="bg-white">
                        <div class=" flex items-center justify-center md:pt-12 pt-10 lg:mx-20">
                            <div class="z-10 w-full px-3 pt-5 md:py-0 flex flex-col md:flex-row items-center gap-10">

                                <div class="flex-1 pt-10 lg:py-10 w-full">
                                    <div class="p-8 md:p-10 lg:p-12 text-white">
                                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold leading-tight text-gray-900">
                                            Learn Syntax.<br>Learn <span class="text-primary">Programming</span>
                                        </h1>
                                        <p class="mt-7 text-md md:text-lg text-gray-700">
                                            Transform your passion for coding into a successful career.
                                            Join Learn Syntax, Purnea’s most trusted programming center for hands-on learning,
                                            expert guidance, and real-world projects to unlock your true potential!
                                        </p>
                                        <div class="mt-10 flex gap-3">
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
                                            <a href="#courses" class="px-3 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-indigo-600 transition-all">
                                                C++
                                            </a>
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
