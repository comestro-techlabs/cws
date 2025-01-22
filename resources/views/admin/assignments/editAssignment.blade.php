@extends('admin.base')

@section('title', 'Add assignment | ')

@section('content')

    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-2  ">
            Edit Assignment <i class="bi bi-arrow-down-circle-fill"></i>
        </h2>
        <a href="{{ route('assignment.index') }}"
            class="bg-blue-500 text-white px-2 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0">Back
            to Assignments List <i class="bi bi-arrow-right"></i></a>
    </div>

    <!-- Edit Form -->
    <div class="flex justify-between p-2">
        <div class="w-full bg-white p-6 shadow-md rounded-lg">

            <form action="{{ route('assignment.update', $assignment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Course</label>
                    <select name="course_id" id="course_id"
                        class="w-full border border-gray-300 rounded-lg shadow-sm sm:text-sm bg-white p-2.5" onchange="updateBatches()">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="batch_id" class="block text-sm font-medium text-gray-700 mb-2">Select Batch</label>
                    <select name="batch_id" id="batch_id"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" >
                        <option value="" disabled {{ old('batch_id') == '' ? 'selected' : '' }}>Select a batch</option>
                       
                    </select>
                    @error('batch_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $assignment->title) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm">
                    @error('title')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="editor" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $assignment->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <button
                        class="bg-blue-500 w-full text-white px-2 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0">Submit</button>
                </div>
            </form>
        {{-- <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="editor" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $assignment->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div> --}}
        {{-- <button type="submit"> submit</button> --}}
    </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
            // JavaScript to filter batches based on course selection
            const allBatches = @json($batches);

            function updateBatches()
            {
                const courseId = document.getElementById('course_id').value;
                const batchDropdown = document.getElementById('batch_id');

                // Clear the current options
                batchDropdown.innerHTML = '<option value="" disabled >Select a Batch</option>';

                // Filter batches based on the selected course
                const filteredBatches = allBatches.filter(batch => batch.course_id == courseId);

                // Populate the batch dropdown
                filteredBatches.forEach(batch => {
                    const option = document.createElement('option');
                    option.value = batch.id;
                    option.textContent = batch.batch_name;
                    batchDropdown.appendChild(option);
                });
                 // Optional: Pre-select the current batch if applicable
        @if($assignment->batch_id)
            document.getElementById('batch_id').value = "{{ $assignment->batch_id }}";
        @endif
            }
             // Initialize the batch dropdown on page load
    document.addEventListener('DOMContentLoaded', updateBatches);
    </script>
@endsection
