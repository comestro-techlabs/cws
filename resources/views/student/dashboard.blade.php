@extends('student.base')

@section('content')
    <div class="bg-gray-900 w-full ">
        <div class="px-[15%] pt-10">
            <h2 class="text-3xl text-white font-bold">My Learning</h2>
            <div class="mb-4 border-b mt-5">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block text-slate-100 p-4 border-b-2 hover:text-gray-100 hover:border-gray-100 dark:hover:text-gray-300 border-white rounded-t-lg"
                            id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">My Course</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-100 hover:border-gray-100 dark:hover:text-gray-300"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">My Payment</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-100 hover:border-gray-300 dark:hover:text-gray-300"
                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Settings</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="px-[15%]">
        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="container mx-auto mt-8 px-4">
                    @forelse($courses as $course)
                        <div class="mb-6 bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                                    class="w-full md:w-1/3 h-48 md:h-auto object-cover" alt="{{ $course->title }}">
                                <div class="p-6 flex-1">
                                    <h2 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h2>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($course->description, 100) }}</p>
                                    <p class="text-sm text-gray-500 mt-4">Instructor: {{ $course->instructor }}</p>
                                    <a href="{{ route('course.show', $course->id) }}"
                                        class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Start Course
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h1 class="text-6xl font-semibold capitalize text-gray-400 mb-5">Empty Courses</h1>
                        <p class="text-xl font-light text-slate-500">Please Explore Our Courses <a href="{{ route('public.training') }}" class="font-normal text-blue-600">Click Here</a></p>
                    @endforelse


                </div>

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
        </div>
    </div>
@endsection
