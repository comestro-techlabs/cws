@extends('admin.base')

@section('title', 'Add Assignment | ')

@section('content')
<div class="col-span-1 md:col-span-6">
    @foreach ($courses as $course)
    <div class="bg-white border shadow-lg mb-10 rounded-xl overflow-hidden">
        <div class="p-4">
          <div class="flex flex-col sm:flex-row">
            <a href="{{route('assignments.review',$course->slug)}}" class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4">
                <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="Course Title" class="w-32 h-32 rounded-lg object-cover">
            </a>
            <div class="flex flex-col justify-between flex-grow min-w-[200px]">
                <div>
                    <h4 class="text-lg font-semibold mb-2">
                        <a href="#" class="hover:text-blue-600">{{ $course->title }}</a>
                    </h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Total Assignments: {{ $course->assignments->count() }}
                    </p>
                </div>
                <div>
                    {{-- <div class="flex justify-between items-center border-t pt-2">
                        <!-- Static Start Course Link -->
                        <a href="#" class="text-sm text-blue-500 hover:underline">Start Course</a>
                    </div> --}}
                    <div class="flex justify-between items-center mt-2">
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            {{ $course->unique_user_count ?? 0 }} {{ Str::plural('Student', $course->unique_user_count ?? 0) }}
                        </span>
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            Total Users Purchased: {{ $course->total_users }} 
                        </span>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
