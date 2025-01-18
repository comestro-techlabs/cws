@extends('admin.base')

@section('title', 'Show Course | ')

@php
    $fields = [
        'title',
        'description',
        'duration',
        'instructor',
        'fees',
        'discounted_fees',
        'category_id',
        'course_image',
    ];
    $countCompletedFields = 0;
    foreach ($fields as $field) {
        if ($course->$field) {
            $countCompletedFields++;
        }
    }
    $countCompletedFields += $course->chapters->isNotEmpty() ? 1 : 0;
    $countCompletedFields += $course->features->count() ? 1 : 0;
    $countCompletedFields += $course->batches->count() ? 1 : 0;
    $totalFields = count($fields) + 3; // Add 2 if chapters and features exist
@endphp

@section('content')
    @if (session('success'))
        <div class="mb-4 p-4 mt-5 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex px-[2%] py-0 flex-col">
        <div class="flex gap-3 my-5 flex-row justify-between items-center">
            <div class="flex flex-1 flex-col border-s-4 border-s-orange-400 pl-3">
                <h2 class="md:text-xl text-lg font-normal dark:text-slate-300 text-slate-500">View Course</h2>
                <p class="text-sm text-slate-400 font-normal">Please fill {{ $countCompletedFields }} of {{ $totalFields }}
                    fields</p>
            </div>

            <div class="inline-flex flex-row md:items-center gap-2" role="group">
                <form action="{{ route(($course->published ? 'course.unpublish' : 'course.publish'), $course->id) }}"
                    method="POST" class="inline-flex" enctype="multipart/form-data">
                    @csrf
                    <button type="submit"
                        class="px-3 py-2 {{ $course->published ? 'bg-red-600  border border-red-600 hover:text-red text-white' : 'bg-teal-600  border border-teal-600 hover:text-teal text-white' }}  rounded-lg">
                        {{ $course->published ? 'Unpublish Course' : 'Publish Course' }}
                    </button>
                </form>
            </div>
        </div>

        <div class="flex  flex-1  md:flex-row flex-col md:items-start gap-5">

            <div class="flex flex-1 gap-5 flex-col">

                @foreach ($fields as $field)
                    <div class="flex flex-1 bg-slate-100 p-3 rounded border">
                        <div class="flex flex-1 flex-col gap-2">
                            <div class="flex flex-1 justify-between">
                                <strong class="text-lg font-normal text-slate-600">{{ ucfirst($field) }}</strong>
                                <button onclick="toggleEdit('{{ $field }}')"
                                    class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Edit</button>
                            </div>

                            <span id="{{ $field }}-value">
                                @if ($course->$field)
                                    {!! $field == 'fees' || $field == 'discounted_fees'
                                        ? '₹ ' . number_format($course->$field, 2)
                                        : ($field == 'duration'
                                            ? $course->$field . ' Weeks'
                                            : ($field == 'category_id'
                                                ? $course->category->cat_title
                                                : ($field == 'course_image'
                                                    ? "<img src='" .
                                                        ($course->$field
                                                            ? asset('storage/course_images/' . $course->$field)
                                                            : 'https://placehold.co/600x400?text=Upload+Image') .
                                                        "' alt='Image Preview' class='w-full h-auto object-cover border'>"
                                                    : e($course->$field)))) !!}
                                @else
                                    <span class="italic">{{ $field }} is empty</span>
                                @endif
                            </span>
                            <form id="{{ $field }}-form"
                                action="{{ route('course.update', ['course' => $course->id, 'field' => $field]) }}"
                                method="POST" enctype="multipart/form-data" style="display: none;"
                                class="flex flex-col w-full">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3 flex flex-1 flex-col gap-1">
                                    @if ($field == 'description')
                                        <textarea name="{{ $field }}" class="border w-full px-3 py-2" rows="5">{{ $course->$field }}</textarea>
                                    @elseif ($field == 'course_image')
                                        <input type="file" name="{{ $field }}" id="{{ $field }}"
                                            onchange="previewImage(event)">
                                        <div class="mt-2">
                                            <img id="{{ $field }}-preview"
                                                src="{{ $course->$field ? asset('storage/course_images/' . $course->$field) : 'https://placehold.co/600x400?text=Upload+Image' }}"
                                                alt="Image Preview" class="w-56 h-32 object-cover border">
                                        </div>
                                    @elseif ($field == 'category_id')
                                        <select name="{{ $field }}" class="px-3 py-2 w-full">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                                    {{ $category->cat_title }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input class="border w-full px-3 py-2"
                                            type="{{ $field == 'fees' || $field == 'discounted_fees' || $field == 'duration' ? 'number' : 'text' }}"
                                            name="{{ $field }}" value="{{ $course->$field }}">
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" class="bg-black text-white px-3 py-2 rounded">Save</button>
                                    <button type="button" onclick="toggleEdit('{{ $field }}')"
                                        class="bg-gray-500 text-white px-3 py-2 rounded">Cancel</button>
                                </div>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Add New Chapter Section --}}

            {{-- Chapters Section --}}

            <div class="flex flex-1 flex-col  gap-5">
                <div class="flex flex-1 bg-slate-100 p-3 rounded border">
                    <div class="flex flex-1 flex-col gap-2">
                        <strong class="text-lg font-normal text-slate-600">Course Status</strong>
                        <span id="course-status">
                            @if ($course->published)
                                <span class="text-green-500">Published</span>
                            @else
                                <span class="text-red-500">Not Published</span>
                            @endif
                        </span>
                    </div>
                </div>


                <div class="flex flex-1 bg-slate-100 flex-col p-3 rounded border">
                    <div class="flex flex-1 justify-between mb-2 ">
                        <strong class="text-lg font-normal text-slate-600">Chapters</strong>
                        <button onclick="toggleAddChapterForm()"
                            class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Add Chapter</button>
                    </div>

                    @if ($course->chapters->isEmpty())
                        <span class="italic">No chapters available</span>
                    @else
                        @foreach ($course->chapters as $chapter)
                            <div class="bg-white p-3 mb-3 rounded border">
                                <div class="flex justify-between">
                                    <strong class="text-md font-normal text-slate-600">Chapter:
                                        {{ $chapter->title }}</strong>
                                    <div class="flex gap-2">
                                        <a href="{{ route('lessons.create', $chapter->id) }}"
                                            class="bg-teal-600 text-white text-sm px-3 py-1 rounded">Add Lesson</a>
                                        <a href="{{ route('chapter.edit', $chapter->id) }}"
                                            class="bg-blue-600 text-white text-sm px-3 py-1 rounded">Edit Chapter</a>
                                        <form action="{{ route('chapter.destroy', $chapter->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this chapter?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white text-sm px-3 py-1 rounded">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    @if ($chapter->lessons && !$chapter->lessons->isEmpty())
                                        <ul class="list-disc ml-5">
                                            @foreach ($chapter->lessons as $lesson)
                                                <li>{{ $lesson->title }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="italic">No lessons available for this chapter</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="flex flex-1  bg-lime-100 px-2 rounded border">
                        <div class="flex flex-1 flex-col gap-2">
                            <form id="add-chapter-form" action="{{ route('chapter.store', $course->id) }}" method="POST"
                                class="flex gap-2 py-2" style="display: none;">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <div class="mb-3">
                                    <label for="title" class="block text-sm font-medium text-slate-600">Chapter
                                        Title</label>
                                    <input type="text" name="title" id="title" class="border w-full px-3 py-2"
                                        required>
                                </div>
                                <button type="submit" class="bg-teal-600 text-white px-3 py-2 rounded">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex flex-1 flex-col bg-slate-100 p-3">
                    <div class="flex flex-1 justify-between mb-2">
                        <strong class="text-lg font-normal text-slate-600">Features</strong>
                        <button onclick="toggleAddFeatureForm()"
                            class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Add Feature</button>
                    </div>

                    @if ($course->features->isEmpty())
                        <span class="italic">No features available</span>
                    @else
                        <ul class="list-disc ml-5">
                            @foreach ($course->features as $feature)
                                <li>{{ $feature->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="flex flex-1 bg-lime-100 px-2 rounded border">
                        <div class="flex flex-1 flex-col gap-2">
                            <form id="add-feature-form" action="{{ route('course.addFeature', $course->id) }}"
                                method="POST" class="flex flex-col gap-2 py-2" style="display: none;">
                                @csrf
                                <div class="mb-3">
                                    <label for="features" class="block text-sm font-medium text-slate-600">Select
                                        Features</label>
                                    <select name="features[]" id="features" class="border w-full px-3 py-2" multiple>
                                        @foreach ($allFeatures as $feature)
                                            <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="bg-teal-600 text-white px-3 py-2 rounded self-end">Add
                                    Features</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex flex-1 flex-col bg-slate-100 p-3">
                    <div class="flex flex-1 justify-between mb-2">
                        <strong class="text-lg font-normal text-slate-600">Batches</strong>
                        <button onclick="toggleAddBatchForm()"
                            class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Add Batch</button>
                    </div>

                    @if ($course->batches->isEmpty())
                        <span class="italic">No batches available</span>
                    @else
                        <ul class="space-y-2">
                            @foreach ($course->batches as $batch)
                                <li
                                    class="flex items-center justify-between p-3 bg-white rounded shadow border border-gray-200">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-800">{{ $batch->batch_name }}</span>
                                        <span class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }} to
                                            {{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $batch->available_seats }}/{{ $batch->total_seats }} Seats
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div id="addBatchForm" class="flex flex-1 mt-2 bg-lime-100 p-2 rounded border hidden">
                        <div class="flex flex-1 flex-col gap-2">
                            <form action="{{ route('batches.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">

                                <!-- Batch Name -->
                                <div class="mb-4">
                                    <label for="batch_name" class="block text-gray-700 font-bold mb-2">Batch Name</label>
                                    <input type="text" name="batch_name" id="batch_name"
                                        class="form-input block w-full mt-1" value="{{ old('batch_name') }}" required>
                                    @error('batch_name')
                                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                @php
                                    $today = date('Y-m-d');
                                @endphp

                                <div class="flex flex-1 gap-3">
                                    <!-- Start Date -->
                                    <div class="mb-4 flex-1">
                                        <label for="start_date" class="block text-gray-700 font-bold mb-2">Start
                                            Date</label>
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-input block w-full mt-1" value="{{ old('start_date') }}"
                                            min="{{ $today }}" required>
                                        @error('start_date')
                                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div class="mb-4 flex-1">
                                        <label for="end_date" class="block text-gray-700 font-bold mb-2">End Date</label>
                                        <input type="date" name="end_date" id="end_date"
                                            class="form-input block w-full mt-1" value="{{ old('end_date') }}" required>
                                        @error('end_date')
                                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-1 gap-3">

                                    <!-- Total Seats -->
                                    <div class="mb-4 flex-1">
                                        <label for="total_seats" class="block text-gray-700 font-bold mb-2">Total
                                            Seats</label>
                                        <input type="number" name="total_seats" id="total_seats"
                                            class="form-input block w-full mt-1" value="{{ old('total_seats') }}"
                                            required>
                                        @error('total_seats')
                                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Available Seats -->
                                    <div class="mb-4 flex-1">
                                        <label for="available_seats" class="block text-gray-700 font-bold mb-2">Available
                                            Seats</label>
                                        <input type="number" name="available_seats" id="available_seats"
                                            class="form-input block w-full mt-1" value="{{ old('available_seats') }}"
                                            required>
                                        @error('available_seats')
                                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-4">
                                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    <script>
   document.getElementById('start_date').addEventListener('change', function() {
        let startDate = new Date(this.value);
        let endDate = new Date(startDate);
        let courseDuration = {{ $course->duration }}; // Get the course duration in days

        endDate.setDate(endDate.getDate() + courseDuration * 7); // Adds the course duration to the start date

        let formattedEndDate = endDate.toISOString().split('T')[0];
        document.getElementById('end_date').value = formattedEndDate;
    });

        function toggleEdit(field) {
            const valueSpan = document.getElementById(field + '-value');
            const form = document.getElementById(field + '-form');
            const isFormVisible = form.style.display === 'block';

            if (isFormVisible) {
                valueSpan.style.display = 'block';
                form.style.display = 'none';
            } else {
                valueSpan.style.display = 'none';
                form.style.display = 'block';
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(event.target.id + '-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function toggleAddChapterForm() {
            const form = document.getElementById('add-chapter-form');
            const isFormVisible = form.style.display === 'block';

            if (isFormVisible) {
                form.style.display = 'none';
            } else {
                form.style.display = 'block';
            }
        }

        function toggleAddFeatureForm() {
            const form = document.getElementById('add-feature-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function toggleAddBatchForm() {
            const form = document.getElementById('addBatchForm');
            form.classList.toggle('hidden');
        }
    </script>
@endsection
