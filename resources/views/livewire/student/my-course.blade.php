<div class="page mt-16 min-h-screen">
    
    <div class="border-b border-gray-300 py-4">
        <div class="container mx-auto px-6 flex items-center">
            <h1 class="text-2xl font-bold text-gray-800">My Courses</h1>
        </div>
    </div>

    
    

    <!-- Courses Section -->
    <div class="container mx-auto px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($courses as $course)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="flex md:flex-col">
                     
                        <div class="basis-1/3">
                            <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                                alt="{{ $course->title }}"
                                class="w-full h-full object-cover">
                        </div>
                      
                        <div class="basis-2/3 p-6 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 truncate">
                                <a href="#" class="hover:text-blue-600 transition-colors duration-200">{{ $course->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <div class="flex justify-between items-center mt-auto">
                                <span class="text-sm text-gray-700">
                                    <strong>Instructor:</strong> {{ $course->instructor }}
                                </span>
                                <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded text-sm font-medium">
                                    ₹{{ $course->discounted_fees }}
                                </span>
                            </div>

                            <!-- Batch Section -->
                            <div class="mt-4">
                                @if ($course->pivot && $course->pivot->batch_id)
                                    <div class="text-sm text-gray-700">
                                        <strong>Batch:</strong>
                                        {{ $course->batches->firstWhere('id', $course->pivot->batch_id)->batch_name }}
                                    </div>
                                @else
                                    <select wire:change="updateBatch({{ $course->id }}, $event.target.value)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                        <option value="">-- Select a Batch --</option>
                                        @foreach ($course->batches as $batch)
                                            <option value="{{ $batch->id }}"
                                                {{ $course->pivot && $course->pivot->batch_id == $batch->id ? 'selected' : '' }}>
                                                {{ $batch->batch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
  
</div>
