<div>
    <div class="bg-white pB-12 overflow-x-hidden">
        <livewire:page-heading title="About"
            description="Our Learn Syntax platform is one of the top learning platforms in India. We provide 360º learning solutions to empower individuals and businesses across the globe with in-demand tech skills."
            image="about-header.png" />

        <!-- Hero Section -->
        <div class="mt-20 mb-20 py-10 px-5 md:px-20">
            <div class="mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-10">
                <!-- Image Section -->
                <div class="flex justify-center">
                    <img src="https://img.freepik.com/free-photo/business-people-using-computers-dark-office_74855-2617.jpg"
                        class="w-96" />
                </div>

                <!-- Text Content Section -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        Empower Your <span class="text-secondary">Future</span> with Learn Syntax
                    </h2>
                    <p class="mt-4 text-gray-600">
                        Learn Syntax is a premier learning platform dedicated to empowering aspiring coders and tech
                        enthusiasts.
                        With a focus on mastering syntax, frameworks, and real-world applications, we provide the tools
                        and
                        resources needed to build a successful career in technology.
                    </p>
                    <button class="mt-6 px-6 py-3 bg-secondary text-white font-medium rounded-lg hover:shadow-xl">
                        Get Started Today!
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-blue-900 text-white py-12 px-6">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">Our Journey</h2>
                <p class="text-center text-gray-300 mb-12">
                    A story of growth, innovation, and commitment to empowering aspiring developers and IT
                    professionals.
                </p>
                <div class="relative">
                    @foreach($this->milestones as $milestone)
                    <div class="flex items-start border-b-2 border-gray-500 mb-12 last:border-b-0">
                        <div class="w-16 text-right pr-4">
                            <h3 class="text-lg font-bold">{{ $milestone['year'] }}</h3>
                        </div>
                        <div class="relative mb-6 pl-8">
                            <h4 class="text-xl font-bold">{{ $milestone['title'] }}</h4>
                            <ul class="mt-2 text-gray-300 list-disc ml-5">
                                @foreach($milestone['achievements'] as $achievement)
                                <li>{{ $achievement }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-20 mb-20 py-12 px-6">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-8">
                    Frequently <span class="text-secondary">Asked</span> Questions
                </h2>
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                    <div class="border border-gray-300 rounded-lg shadow">
                        <button wire:click="toggleFaq('{{ $faq['id'] }}')"
                            class="w-full flex justify-between items-center p-4 bg-white text-left hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-500">
                            <span class="text-lg font-medium text-gray-800">{{ $faq['question'] }}</span>
                            <svg class="w-6 h-6 transform transition-transform text-gray-600 {{ $faq['isOpen'] ? 'rotate-180' : '' }}"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="{{ $faq['isOpen'] ? '' : 'hidden' }} p-4 bg-gray-50 text-gray-700">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>