<div>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Learning Journey</h1>
                    <p class="mt-1 text-sm text-gray-500">Track your progress and manage your enrolled courses</p>
                </div>
                <a href="{{ route('student.course') }}"
                    class="mt-4 sm:mt-0 group inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-sm font-medium hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <span class="mr-2">Explore New Courses</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Empty state -->
            @if($courses->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="mx-auto h-24 w-24 bg-blue-50 flex items-center justify-center rounded-full">
                    <svg class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Start Your Learning Journey</h3>
                <p class="mt-2 text-gray-500">Explore our courses and enroll in the ones that match your learning goals.</p>
                <a href="{{ route('student.course') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Browse Available Courses
                </a>
            </div>
            @else
            <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2">
                @foreach ($courses as $course)
                <div class="group bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 overflow-hidden">
                    <div class="flex flex-row">
                        <!-- Course Image with Progress Overlay -->
                        <div class="relative w-48 h-48">
                            <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                                alt="{{ $course->title }}"
                                class="h-full w-full object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                <div class="w-full">
                                    <div class="h-1 w-full bg-white/30 rounded-full overflow-hidden">
                                        <div class="h-full w-[45%] bg-blue-500 rounded-full" style="width: {{ $course->progress }}%;"></div>
                                    </div>
                                    <div class="mt-1 flex justify-end">
                                        <span class="text-white text-xs"> {{ $course->progress  }} %</span>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Course Content -->
                        <div class="flex-1 p-4 min-w-0">
                            <div class="flex flex-col h-full">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-base font-medium text-gray-900">{{ $course->title }}</h3>
                                        <div class="mt-1 flex items-center text-sm text-gray-500">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                            </svg>
                                            {{ $course->instructor }}
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                        ₹{{ $course->discounted_fees }}
                                    </span>
                                </div>

                                <!-- Batch Information -->
                                <div class="mt-4 pt-3 border-t border-gray-100">
                                    @if($selectedBatch && isset($selectedBatch[$course->id]))
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="flex-shrink-0 w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                            <span class="text-sm text-gray-600">Batch: <span class="font-medium">{{ $course->batches->firstWhere('id', $selectedBatch[$course->id])?->batch_name }}</span></span>
                                        </div>
                                        <button wire:click="toggleEdit({{ $course->id }})"
                                            class="text-sm text-blue-600 hover:text-blue-700">
                                            Change
                                        </button>
                                    </div>
                                    <button wire:click="$dispatch('getting-course', { id: {{ $course->id}} })" class="bg-purple-800 mt-10 hover:bg-purple-600 text-white px-4 py-2 rounded">
                                        Add Review
                                    </button>
                                    @endif

                                    @if($editingCourseId === $course->id)
                                    <div class="mt-2 space-y-2">
                                        <select wire:model.live="selectedBatch.{{ $course->id }}"
                                            class="w-full text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Select Batch</option>
                                            @foreach ($course->batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="flex items-center space-x-2">
                                            <button wire:click="updateBatch({{ $course->id }})"
                                                class="flex-1 inline-flex justify-center items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                                Update
                                            </button>
                                            <button wire:click="toggleEdit({{ $course->id }})"
                                                class="inline-flex justify-center items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                                Cancel
                                            </button>
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
            <div wire:transition class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" wire:click.self="$toggle('showModal')">
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
                            <select wire:model="course_id" disabled id="course_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                            <textarea wire:model="review" id="review" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('review') }}</textarea>
                            @error('review') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Rating -->
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                            <div class="flex items-center space-x-2">
                                <div>
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span wire:click="rate({{ $i }})"
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
                            <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 rounded-md">
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
                    <p class="mt-4 text-gray-600">Your feedback is invaluable to us. We truly appreciate you taking the time to share your thoughts. Your input helps us improve and provide the best experience possible!</p>
                    <div class="mt-6">
                        <button wire:click="offModel" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">Close</button>
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

</div>