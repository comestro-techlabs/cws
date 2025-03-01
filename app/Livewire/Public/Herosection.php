<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Herosection extends Component
{
    public function render()
    {
        return <<<'HTML'
            <div>
                <div class="bg-gradient-to-r  to-purple-100 via-purple-300 from-purple-50">
                <nav id="navbar" class="sticky  top-4 max-w-7xl mx-auto  bottom-auto z-40 w-full  transition-all duration-300  rounded-xl ">
                    <livewire:public.header />
                </nav>
                <!-- Content Section -->
                <div class="md:pt-[30px] ">
                    <!-- Hero Section with Gradient -->
                    <div class="relative flex items-center md:pt-12 pt-10">
                        <div class="lg:px-[10%] w-full px-3 pt-5 md:py-0 gap-10 flex flex-col md:flex-row items-center">
                            <!-- Left Section: Text Content -->
                            <div
                                class="flex-1 pt-10 lg:py-10 lg:w-1/2  bg-cover bg-bottom lg:bg-none bg-[url('{{ asset('hero-bg.png') }}')] w-full">
                                <div class="rounded-2xl px-3 pb-5">
                                    <h1
                                        class="text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-slate-800 tracking-tight">
                                        Learn Syntax. <br> Learn Programming
                                    </h1>
                                    <p class="mt-2 w-[60%] text-md md:p-0 lg:hidden">Transform your passion for coding into a successful career </p>
                                    <p class="hidden lg:flex mt-5 w-[60%] text-lg md:p-0 lg:w-[90%]"> Transform your passion for coding into a successful career at Learn Syntax, Purnea's
                                        most trusted programming center. Join us for hands-on learning, expert guidance,
                                        and
                                        real-world projects to unlock your true potential!
                                    </p>
                                    </span>
                                    </p>
                                </div>
                            </div>

                            <div
                                class="w-full py-5 lg:w-1/2 hidden lg:flex bg-cover h-[400px] bg-right-bottom bg-[url('{{ asset('hero-bg.png') }}')]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
        HTML;
    }
}
