@extends('admin.base')

@section('title', 'Show Course | ')

@php
    $fields = ['title', 'description', 'duration', 'instructor', 'fees', 'discounted_fees', 'category_id', 'course_image'];
    $countCompletedFields = 0;
    foreach ($fields as $field) {
        if ($course->$field) {
            $countCompletedFields++;
        }
    }
    $countCompletedFields += ($course->chapters->isNotEmpty() ? 1 : 0);
    $countCompletedFields += ($course->features->count() ? 1 : 0);
    $totalFields = count($fields) + 2; // Add 2 if chapters and features exist
@endphp

@section('content')
    <div class="flex px-[2%] py-0 flex-col">
        <div class="flex gap-3 my-5 flex-row justify-between items-center">
            <div class="flex flex-1 flex-col border-s-4 border-s-orange-400 pl-3">
                <h2 class="md:text-xl text-lg font-normal dark:text-slate-300 text-slate-500">View Course</h2>
                <p class="text-sm text-slate-400 font-normal">Please fill {{ $countCompletedFields }} of {{ $totalFields }} fields</p>
            </div>
        
            <div class="inline-flex flex-row md:items-center gap-2" role="group">
                <form action="{{ route('course.publish', $course->id) }}" method="POST" class="inline-flex" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="px-3 py-2 bg-teal-600 text-white rounded-lg {{ $countCompletedFields == $totalFields ? 'opacity-100' : 'opacity-50 cursor-not-allowed' }}" {{ $countCompletedFields != $totalFields ? 'disabled' : '' }}>
                        Publish Course
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
                        <button onclick="toggleEdit('{{ $field }}')" class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Edit</button>
                       </div>

                        <span id="{{ $field }}-value">
                            @if ($course->$field)
                                {{ ($field == 'fees' || $field == 'discounted_fees') ? '₹ ' . number_format($course->$field, 2) : (($field == 'duration') ? $course->$field . ' Weeks' : ($field == 'category_id' ? $course->category->cat_title : $course->$field)) }}
                            @else
                                <span class="italic">{{ $field }} is empty</span>
                            @endif
                        </span>
                        <form id="{{ $field }}-form" action="{{ route('course.update', ['course' => $course->id, 'field' => $field]) }}" method="POST" style="display: none;" class="flex flex-col w-full">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3 flex flex-1 flex-col gap-1">
                                @if ($field == 'description')
                                    <textarea name="{{ $field }}" class="border w-full px-3 py-2" rows="5">{{ $course->$field }}</textarea>
                                @elseif ($field == 'course_image')
                                    <input type="file" name="{{ $field }}">
                            
                                @elseif ($field == 'category_id')
                                    <select name="{{ $field }}" class="px-3 py-2 w-full">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $course->category_id ? 'selected' : '' }}>{{ $category->cat_title }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input class="border w-full px-3 py-2" type="{{ ($field == 'fees' || $field == 'discounted_fees' || $field == 'duration') ? 'number' : 'text' }}" name="{{ $field }}" value="{{ $course->$field }}">
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="bg-black text-white px-3 py-2 rounded">Save</button>
                                <button type="button" onclick="toggleEdit('{{ $field }}')" class="bg-gray-500 text-white px-3 py-2 rounded">Cancel</button>
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
                    <button onclick="toggleAddChapterForm()" class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Add Chapter</button>
                </div>
            
                @if ($course->chapters->isEmpty())
                    <span class="italic">No chapters available</span>
                @else
                    @foreach ($course->chapters as $chapter)
                        <div class="bg-white p-3 mb-3 rounded border">
                            <div class="flex justify-between">
                                <strong class="text-md font-normal text-slate-600">Chapter: {{ $chapter->title }}</strong>
                                <div class="flex gap-2">
                                    <a href="{{ route('lessons.create', $chapter->id) }}" class="bg-teal-600 text-white text-sm px-3 py-1 rounded">Add Lesson</a>
                                    <a href="{{ route('chapter.edit', $chapter->id) }}" class="bg-blue-600 text-white text-sm px-3 py-1 rounded">Edit Chapter</a>
                                    <form action="{{ route('chapter.destroy', $chapter->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this chapter?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white text-sm px-3 py-1 rounded">Delete</button>
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
                        <form id="add-chapter-form" action="{{ route('chapter.store', $course->id) }}" method="POST" class="flex gap-2 py-2" style="display: none;">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="mb-3">
                                <label for="title" class="block text-sm font-medium text-slate-600">Chapter Title</label>
                                <input type="text" name="title" id="title" class="border w-full px-3 py-2" required>
                            </div>
                            <button type="submit" class="bg-teal-600 text-white px-3 py-2 rounded">Add</button>
                        </form>
                    </div>
                </div>
               </div>

                <div class="flex flex-1 flex-col bg-slate-100 p-3">
                    <div class="flex flex-1 justify-between mb-2">
                        <strong class="text-lg font-normal text-slate-600">Features</strong>
                        <button onclick="toggleAddFeatureForm()" class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Add Feature</button>
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
                            <form id="add-feature-form" action="{{ route('course.addFeature', $course->id) }}" method="POST" class="flex flex-col gap-2 py-2" style="display: none;">
                                @csrf
                                <div class="mb-3">
                                    <label for="features" class="block text-sm font-medium text-slate-600">Select Features</label>
                                    <select name="features[]" id="features" class="border w-full px-3 py-2" multiple>
                                        @foreach ($allFeatures as $feature)
                                            <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="bg-teal-600 text-white px-3 py-2 rounded self-end">Add Features</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
               
        </div>
    </div>

    <script>
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
    </script>
@endsection
