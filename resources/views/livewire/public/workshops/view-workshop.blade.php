<div class="bg-gray-50 min-h-screen mt-12">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Workshop Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Left Section: Image, Title, and Time -->
                    <div class="p-6">
                        <div class="relative overflow-hidden rounded-lg h-80">
                            <img 
                                src="{{ asset('storage/' . $workshop->image) }}" 
                                alt="{{ $workshop->title }}"
                                class="w-full h-full object-cover"
                                onerror="this.src='https://via.placeholder.com/600x400?text=Workshop+Image'"
                            >
                        </div>

                        <h1 class="text-2xl font-bold text-gray-900 mt-6 mb-4">{{ $workshop->title }}</h1>

                        <div class="space-y-4">
                            <!-- Time Info -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Time</p>
                                        <p class="font-medium text-gray-900">{{ $workshop->time }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Info -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Date</p>
                                        <p class="font-medium text-gray-900">{{ $workshop->date ? \Carbon\Carbon::parse($workshop->date)->format('F j, Y') : 'TBA' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section: Description -->
                    <div class="p-6 border-t lg:border-t-0 lg:border-l border-gray-200">
                        @if($workshop->description)
                            <div class="prose max-w-none">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Workshop Details</h2>
                                @if(is_array($workshop->description))
                                    @foreach($workshop->description as $section)
                                        <div class="mb-6 bg-gray-50 rounded-lg p-6">
                                            @if(is_array($section) && isset($section['title']))
                                                <h3 class="text-lg font-semibold text-gray-900 mb-3">
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
                                @else
                                    <div class="bg-gray-50 rounded-lg p-6">
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