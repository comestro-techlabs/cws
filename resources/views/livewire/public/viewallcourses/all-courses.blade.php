<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section with Animated Background -->
    <div class="relative bg-gradient-to-r from-[#662d91] via-purple-600 to-[#662d91] bg-[size:400%] animate-gradient py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mt-5">
                <h1 class="text-4xl font-bold text-white sm:text-5xl">
                    Explore Our Courses
                </h1>
                <p class="mt-4 text-xl text-purple-100 max-w-2xl mx-auto">
                    Transform your career with our industry-leading programming courses
                </p>
            </div>
        </div>
        <div class="absolute inset-0 bg-[url('/img/grid.svg')] opacity-10"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8 py-12">
            <!-- Sidebar Filters - Collapsible on Mobile -->
            <div x-data="{ open: false }" class="lg:w-64 flex-shrink-0">
                <!-- Mobile Filter Button -->
                <button @click="open = !open" class="lg:hidden w-full mb-4 px-4 py-2 bg-white rounded-lg shadow-sm flex items-center justify-between">
                    <span class="font-medium text-gray-700">Filters</span>
                    <svg class="w-5 h-5" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Filter Content -->
                <div :class="{'hidden': !open}" class="lg:block">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>

                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <input type="text"
                                wire:model.live.debounce.300ms="search"
                                class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                                placeholder="Search courses...">
                        </div>

                        <!-- Course Type -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Type</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="courseType" value="" class="text-purple-600">
                                    <span class="ml-2 text-gray-700">All</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="courseType" value="online" class="text-purple-600">
                                    <span class="ml-2 text-gray-700">Online</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="courseType" value="offline" class="text-purple-600">
                                    <span class="ml-2 text-gray-700">Offline</span>
                                </label>
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="" class="text-purple-600">
                                    <span class="ml-2 text-gray-700">All</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="free" class="text-purple-600">
                                    <span class="ml-2 text-gray-700">Free</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="priceRange" value="paid" class="text-purple-600">
                                    <span class="ml-2 text-gray-700">Paid</span>
                                </label>
                            </div>
                        </div>

                        <!-- Reset Filters -->
                        <button wire:click="resetFilters"
                            class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1" x-data="{ gridView: true }">
                <!-- Grid/List View Toggle -->
                <div class="flex justify-end mb-4">
                    <div class="bg-white rounded-lg shadow-sm p-1">
                        <button @click="gridView = true"
                                :class="{'bg-purple-100 text-purple-600': gridView}"
                                class="px-3 py-1 rounded-md">
                            <i class="fas fa-grid-2"></i>
                        </button>
                        <button @click="gridView = false"
                                :class="{'bg-purple-100 text-purple-600': !gridView}"
                                class="px-3 py-1 rounded-md">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Course Grid -->
                <div class="relative">
                    <!-- Loader Component -->
                    <x-loader />

                    <div :class="{'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8': gridView, 'space-y-4': !gridView}">
                        @forelse($courses as $course)
                            <a href="{{ route('public.courseDetail', ['slug' => $course->slug]) }}" wire:navigate class="block">
                                <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 flex" :class="{'flex-col': gridView, 'items-center': !gridView}">
                                    <!-- Course Card Content -->
                                    <div class="relative" :class="{'w-full': gridView, 'w-1/3': !gridView}">
                                        <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                                            alt="{{ $course->title }}"
                                            class="object-cover rounded-t-2xl"
                                            :class="{'w-full h-48': gridView, 'h-full rounded-l-2xl rounded-tr-none': !gridView}">

                                        <!-- Course Type Badge -->
                                        <div class="absolute top-4 left-4">
                                            <div class="px-3 py-1 rounded-full text-sm font-medium {{ $course->course_type === 'online' ? 'bg-blue-600 text-white' : 'bg-green-600 text-white' }} flex items-center">
                                                @if($course->course_type === 'online')
                                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                @endif
                                                {{ ucfirst($course->course_type) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-6" :class="{'w-full': gridView, 'w-2/3': !gridView}">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $course->title }}</h3>
                                        <p class="text-gray-600 line-clamp-2 mb-4">{{ $course->description }}</p>

                                        <div class="flex items-center text-sm text-gray-500 mb-4">
                                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $course->duration }} Weeks
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div>
                                                @if($course->discounted_fees > 0)
                                                    <p class="text-2xl font-bold text-purple-600">₹{{ $course->discounted_fees }}</p>
                                                    <p class="text-sm text-gray-500 line-through">₹{{ $course->fees }}</p>
                                                @else
                                                    <p class="text-xl font-bold text-green-600">Free</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <div class="bg-white rounded-lg p-8 max-w-md mx-auto">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">No courses found</h3>
                                    <p class="mt-2 text-gray-500">Try adjusting your search or filter criteria</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Load More Button -->
                    @if($hasMorePages)
                        <div class="text-center mt-8">
                            <button wire:click="loadMore"
                                class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                Load More Courses
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.animate-gradient {
    animation: gradient 8s linear infinite;
}
</style>
@endpush

@push('scripts')
<script>
    // Infinite scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                @this.loadMore()
            }
        })
    }, {
        root: null,
        threshold: 0.5
    })

    // Observe the Load More button
    document.addEventListener('livewire:load', function () {
        const loadMoreButton = document.querySelector('[wire\\:click="loadMore"]')
        if (loadMoreButton) {
            observer.observe(loadMoreButton)
        }
    })
</script>
@endpush
