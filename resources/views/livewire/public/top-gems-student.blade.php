<div class="relative mt-10 md:mt-5 bg-gradient-to-br from-purple-50 via-white to-purple-100">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32">
        <!-- Hero Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900">
                Choose Your <span class="text-purple-600">Learning Path</span>
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
                Flexible learning options to fit your schedule - attend classes at our center,
                learn online, or access free programming articles.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-20">
                    <div class="px-6 py-5 border-b">
                        <h2 class="text-lg font-semibold text-gray-900">Weekly Top Scorers</h2>
                        <span class="text-sm text-gray-500">Gems</span>
                    </div>
                    <div class="px-6 py-5">
                        <select wire:model.live="selectedWeekStart"
                            class="w-full p-3 mb-4 border rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                            @foreach(array_slice($weekOptions, 0, 3) as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-600 mb-4">
                            Showing results for {{ $this->weekStart->format('M d') }} -
                            {{ $this->weekEnd->format('M d, Y') }}
                        </p>
                        @if($topScorers->isEmpty())
                            <p class="text-gray-500">No top scorers for this week (based on activity).</p>
                        @else
                            <ul class="space-y-4">
                                @foreach($topScorers as $index => $scorer)
                                    <li class="flex items-center">
                                        <span
                                            class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-100 text-purple-800 font-semibold mr-3">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img class="w-full h-full object-cover ring-2 ring-purple-600 ring-offset-2"
                                                src="{{ $scorer['displayImage'] ?? 'https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png' }}"
                                                alt="{{ $scorer['name'] }}'s Profile" loading="lazy"
                                                onerror="this.src='https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png'" />
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <span class="text-sm text-gray-900 font-medium">{{ $scorer['name'] }}</span>
                                            <div class="flex items-center justify-between text-sm text-gray-500 mt-1">
                                                <span class="flex items-center gap-1">
                                                    @if($scorer['trend'] === 'up')
                                                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 3l-7 7h4v7h6v-7h4l-7-7z" />
                                                        </svg>
                                                    @elseif($scorer['trend'] === 'down')
                                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 17l7-7h-4V3H7v7H3l7 7z" />
                                                        </svg>
                                                    @elseif($scorer['trend'] === 'new')
                                                        <span class="text-blue-500 text-xs font-semibold">New</span>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M5 10h10v2H5v-2z" />
                                                        </svg>
                                                    @endif
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    {{ $scorer['gems'] }}
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                                                        <defs>
                                                            <linearGradient id="gemGradient_{{ $index }}" x1="0%" y1="0%"
                                                                x2="100%" y2="100%">
                                                                <stop offset="0%" style="stop-color:#60A5FA" />
                                                                <stop offset="50%" style="stop-color:#8B5CF6" />
                                                                <stop offset="100%" style="stop-color:#EC4899" />
                                                            </linearGradient>
                                                        </defs>
                                                        <path fill="url(#gemGradient_{{ $index }})"
                                                            d="M12 1L3 9l9 13l9-13l-9-8zm0 3.5L6.5 9h11L12 4.5zM5 10l7 10l7-10H5z" />
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