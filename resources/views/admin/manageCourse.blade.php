@extends('admin/base')

@section('title', 'Manage Course |')

@section('content')
    <div class="flex flex-1 flex-col">
        <div class="md:px-[10%] px-5 py-5">
            <div class="flex gap-3 justify-between items-center">

                <h2 class="md:text-2xl text-lg font-semibold capitalize">@if(isset($_GET['search']) && $_GET['search'] !== "")
                    {{$_GET['search']}}
                @else 
                    {{"Manage all"}}
                @endif Courses ({{count($courses)}})</h2>


                {{-- search form starts here --}}
                <form action="{{ route('course.search') }}" method="get" class="max-w-md mx-auto">
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" name="search"
                            value="{{old('search')}}"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search course by name..." size="60"  />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
                {{-- search form ends here --}}


                <div class="inline-flex rounded-md items-center" role="group">
                    <a href="{{ route('course.create') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                        Add Course
                    </a>
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-r rounded-e-lg border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                        Download PDF
                    </button>
                </div>

            </div>
            <div class="relative overflow-x-auto flex-1 border mt-10">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Instructor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fees
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Duration
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $course->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $course->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $course->instructor }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($course->discounted_fees)
                                        {{ $course->discounted_fees }}
                                        <span class=""><del>{{ $course->fees }}</del></span>
                                    @else
                                        {{ $course->fees }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($course->course_image)
                                        <img src="{{ asset('storage/image/' . $course->course_image) }}" width="50"
                                            alt="course image">
                                    @else
                                        <img src="{{ asset('storage/default-course.jpg') }}" width="50"
                                            alt="course image">
                                    @endif
                                </td>
                                <td>
                                    {{ $course->duration }} Week
                                    @if ($course->duration > 1)
                                        ({{ $course->duration }} Weeks)
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('course.edit', $course->id) }}"
                                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Edit
                                    </a>
                                    <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                        class="inline-flex">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="delete"
                                            class="px-3 py-3 text-sm font-medium text-white bg-red-500" value="X">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    @endsection
