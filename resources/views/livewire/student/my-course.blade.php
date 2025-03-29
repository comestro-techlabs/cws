<div>
    <x-loader />
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Learning Journey</h1>
                    <p class="mt-1 text-sm text-gray-500">Track your progress and manage your enrolled courses</p>
                </div>
                <a wire:navigate href="{{ route('student.exploreCourses') }}"
                    class="mt-4 sm:mt-0 group inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-sm font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <span class="mr-2">Explore New Courses</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Course Grid -->
            @if($courses->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="mx-auto h-24 w-24 bg-blue-50 flex items-center justify-center rounded-full">
                    <svg class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Start Your Learning Journey</h3>
                <p class="mt-2 text-gray-500">Explore our courses and enroll in the ones that match your learning goals.
                </p>
                <a wire:navigate href="{{ route('student.exploreCourses') }}"
                    class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Browse Available Courses
                </a>
            </div>
            @else
            <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2">
                @foreach ($courses as $course)
                <div
                    class="group bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden">
                    <div class="flex flex-col sm:flex-row">
                        <!-- Course Image with Progress -->
                        <div class="relative w-full sm:w-48 h-48">
                            <img src="{{ asset('storage/' . $course->course_image) }}" alt="{{ $course->title }}"
                                class="h-full w-full object-cover">
                            <!-- New Progress Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-4">
                                <div class="flex items-center justify-between text-white mb-2">
                                    <span class="text-sm font-medium">Progress</span>
                                    <span class="text-sm">{{ $progress[$course->id] ?? 0 }}%</span>
                                </div>
                                <div class="w-full bg-white/20 rounded-full h-1.5">
                                    <div class="bg-blue-500 h-1.5 rounded-full transition-all duration-500"
                                        style="width: {{ $progress[$course->id] ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Content -->
                        <div class="flex-1 p-5">
                            <div class="flex flex-col h-full">
                                <div class="mb-4">
                                    <div class="flex items-start justify-between">
                                        <h3
                                            class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $course->title }}
                                        </h3>
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700">
                                            ₹{{ $course->discounted_fees }}
                                        </span>
                                    </div>
                                    <div class="mt-2 flex items-start text-sm text-gray-500 justify-between">
                                        <div class="div flex">
                                            <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                            </svg>
                                            {{ $course->instructor }}
                                        </div>
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700">
                                            {{ $course->course_type }}
                                        </span>
                                    </div>
                                    <!-- Batch Information -->
                                    <div class="mt-2 flex items-center justify-between">
                                        <div class="flex items-center text-sm">
                                            <!-- Calendar Icon -->
                                            <svg class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>

                                            <!-- Batch Display -->
                                            <div class="flex items-center">
                                                @php
                                                $currentBatch = $course->batches->where('id',
                                                $selectedBatch[$course->id] ?? null)->first();
                                                @endphp

                                                @if($currentBatch)
                                                <span class="text-gray-600">{{ $currentBatch->batch_name }}</span>
                                                <button wire:click="viewCourse({{ $course->id }})"
                                                    class="ml-2 p-1 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-200
                                                    {{ !$hasAccess ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    @if(!$hasAccess) disabled @endif>
                                                    @if(!$hasAccess)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                </button>
                                                @else
                                                <button wire:click="viewCourse({{ $course->id }})"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Select Batch
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Batch Update Section -->
                                    @if($viewingCourse && $selectedCourse && $selectedCourse->id === $course->id)
                                    <div class="mt-4 bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                                        <div class="space-y-4">
                                            <!-- Batch Selection -->
                                            <div class="flex flex-col space-y-3">
                                                <select wire:model.live="selectedBatch.{{ $course->id }}"
                                                    class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Choose batch</option>
                                                    @foreach($course->batches as $batch)
                                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                                    @endforeach
                                                </select>

                                                <!-- Buttons - Responsive Layout -->
                                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 ">
                                                    <button wire:click="updateBatch({{ $course->id }})"
                                                        wire:loading.attr="disabled"
                                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 disabled:opacity-50 transition-colors">
                                                        <span wire:loading.remove
                                                            wire:target="updateBatch({{ $course->id }})">
                                                            <div class="flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Update Batch
                                                            </div>
                                                        </span>
                                                        <span wire:loading wire:target="updateBatch({{ $course->id }})"
                                                            class="inline-flex items-center">
                                                            <svg class="animate-spin h-4 w-4 mr-2" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                    stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor"
                                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                                </path>
                                                            </svg>
                                                            Processing...
                                                        </span>
                                                    </button>

                                                    <button wire:click="closeView"
                                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-colors">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- resources/views/livewire/review-form.blade.php -->
            @if ($showModal)
            <div wire:transition class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                wire:click.self="$toggle('showModal')">
                <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md" wire:click.stop>
                    <h2 class="text-2xl font-semibold mb-6">Submit a Review</h2>

                    @if (session()->has('message'))
                    <div class="mb-4 text-green-600">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form wire:submit.prevent="addReview">
                        <!-- Course ID -->
                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                            <select wire:model="course_id" disabled id="course_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Select a Course</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Review -->
                        <div class="mb-4">
                            <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
                            <textarea wire:model="review" id="review" rows="4"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('review') }}</textarea>
                            @error('review') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Rating -->
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                            <div class="flex items-center space-x-2">
                                <div>
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++) <span wire:click="rate({{ $i }})"
                                            style="cursor: pointer; font-size: 2rem; color: {{ $i <= $rating ? '#FFA726' : 'gray' }};">
                                            &#9733;
                                            </span>
                                            @endfor
                                    </div>

                                    <!-- Display the selected rating -->
                                    <div class="mt-2">
                                        <strong>Selected Rating: {{ $rating }} </strong>
                                    </div>
                                </div>
                            </div>

                            @error('rating')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            @if($isRated)
            <div wire:transition class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg text-center">
                    <h2 class="text-xl font-semibold text-gray-800">Thanks, Champ!</h2>
                    <p class="mt-4 text-gray-600">Your feedback is invaluable to us. We truly appreciate you taking the
                        time to share your thoughts. Your input helps us improve and provide the best experience
                        possible!</p>
                    <div class="mt-6">
                        <button wire:click="offModel"
                            class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">Close</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>

    <script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('alert', (data) => {
            const type = data[0].type;
            const message = data[0].message;

            // You can use your preferred alert library here
            if (type === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: message,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                });
            }
        });
    });
    </script>

</div>