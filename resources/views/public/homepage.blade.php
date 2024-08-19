@extends('public.layout')


@section('content')
    <x-hero />


    <!-- Heading Section -->
    <div class="bg-blue-100 py-12 px-4 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
            Elevate Your Skills with Our Courses
        </h2>
        <p class="text-lg font-medium text-gray-700">
            Unleash your potential and take the first step towards a successful career. Our expert-led courses are designed
            to equip you with the skills you need to excel.
        </p>
        <p class="text-sm font-light text-gray-600 mt-4">
            Join a community of learners and transform your passion into proficiency. Your journey starts here!
        </p>
    </div>

    <div class="grid md:grid-cols-4 px-3 md:px-10 gap-5 grid-cols-1 py-5 bg-white flex-1">
        @foreach ($courses as $course)
            <x-course-card :course="$course" />
        @endforeach
    </div>

    <div class="flex flex-1 w-full">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 text-center my-8 flex-1">
            Students' Reviews on <span class="text-blue-600">Google Business</span>
        </h2>
    </div>

    <div class="grid flex-1 grid-cols-3 gap-3">
        <x-review-card/>
    </div>
    
@endsection
