 @extends('admin.base')

@section('title', 'Add assigment | ')

@section('content')
<div class="bg-gray-100 py-10 min-h-screen">
    <div class=" mx-auto px-6">
        <h2 class="text-4xl font-semibold text-center text-gray-800 mb-8">Create Assignment</h2>
        <!-- Success and Error Messages -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form action="{{ route('assignment.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Assignment Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Assignment Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter assignment name" value="{{old('title')}}">
                    @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Instructions -->
                <div>
                    <label for="editor" class="block text-sm font-medium text-gray-700 mb-2">Instructions (Optional)</label>
                    <textarea name="description" id="editor"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 h-32 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter instructions">{{old('description')}}</textarea>
                    @error('description')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Course Dropdown -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Select Course</label>
                    <select name="course_id" id="course_id"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent" onchange="updateBatches()">
                        <option value="" disabled {{ old('course_id') == '' ? 'selected' : '' }}>Select a course</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                {{-- batch --}}
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

                <div class="mt-4">
                    <label class="block text-gray-700 mb-2">Status</label>
                    <input type="checkbox" name="status" value="1" class="mr-2"> Active
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Create Assignment
                    </button>
                </div>
            </form>
        </div>
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

    function updateBatches() {
        const courseId = document.getElementById('course_id').value;
        const batchDropdown = document.getElementById('batch_id');

        // Clear the current options
        batchDropdown.innerHTML = '<option value="" disabled>Select a Batch</option>';

        // Filter batches based on the selected course
        const filteredBatches = allBatches.filter(batch => batch.course_id == courseId);

        if (filteredBatches.length > 0) {
            filteredBatches.forEach(batch => {
                const option = document.createElement('option');
                option.value = batch.id;
                option.textContent = batch.batch_name;
                option.selected = batch.id == {{ old('batch_id') ? old('batch_id') : 'null' }} ? true : false; // Handle old value
                batchDropdown.appendChild(option);
            });
        } else {
            // If no batches found, show a disabled placeholder
            const option = document.createElement('option');
            option.value = "";
            option.textContent = "No batches available";
            option.disabled = true;
            batchDropdown.appendChild(option);
        }
    }

    // Automatically populate batches if old input exists
    document.addEventListener("DOMContentLoaded", function () {
        if (document.getElementById('course_id').value) {
            updateBatches();
        }
    });
</script>

@endsection




