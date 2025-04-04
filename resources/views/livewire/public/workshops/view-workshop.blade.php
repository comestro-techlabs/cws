<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen pt-16 pb-12 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Workshop Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Left Section: Image, Title, and Time -->
                    <div class="relative">
                        <!-- Hero Image with Overlay -->
                        <div class="relative h-96 lg:h-full">
                            <img 
                                src="{{ asset('storage/' . $workshop->image) }}" 
                                alt="{{ $workshop->title }}"
                                class="w-full h-full object-cover"
                                onerror="this.src='https://via.placeholder.com/800x600?text=Workshop+Image'"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        </div>

                        <!-- Content Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <h1 class="text-3xl font-bold text-white mb-6">{{ $workshop->title }}</h1>
                            
                            <!-- Info Cards -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Time Card -->
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-indigo-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600 uppercase tracking-wide">Time</p>
                                            <p class="font-semibold text-gray-900">{{ $workshop->time }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date Card -->
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-indigo-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600 uppercase tracking-wide">Date</p>
                                            <p class="font-semibold text-gray-900">
                                                {{ $workshop->date ? \Carbon\Carbon::parse($workshop->date)->format('F j, Y') : 'TBA' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section: Description -->
                    <div class="p-8 lg:border-l border-gray-100 bg-gray-50/50">
                        @if($workshop->description)
                            <div class="prose max-w-none">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="p-2 bg-indigo-500 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    Workshop Details
                                </h2>
                                
                                @if(is_array($workshop->description))
                                    <div class="space-y-6">
                                        @foreach($workshop->description as $section)
                                            <div class="bg-white rounded-xl p-6 shadow-sm">
                                                @if(is_array($section) && isset($section['title']))
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                                        <span class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                                                        {{ $section['title'] }}
                                                    </h3>
                                                    @if(isset($section['content']))
                                                        <div class="text-gray-600 leading-relaxed">
                                                            {{ $section['content'] }}
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="text-gray-600 leading-relaxed">
                                                        {{ is_string($section) ? $section : '' }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-white rounded-xl p-6 shadow-sm">
                                        <div class="text-gray-600 leading-relaxed">
                                            {{ $workshop->description }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>