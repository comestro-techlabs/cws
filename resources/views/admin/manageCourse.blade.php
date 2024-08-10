@extends('admin/base')

@section('title', 'Manage Course |')

@section('content')
    <div class="flex flex-1 flex-col">
        <div class="md:px-[10%] px-5 py-5">
            <div class="flex gap-3 justify-between">
                <h2 class="md:text-2xl text-lg font-semibold">Manage Courses (3)</h2>
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <a href="{{ route('course.create') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                        Add Course
                    </a>
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
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
                                    {{$course->id}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$course->title}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$course->instructor}}
                                </td>
                                <td class="px-6 py-4">
                                     @if ($course->discounted_fees)
                                         {{$course->discounted_fees}}
                                         <span class=""><del>{{$course->fees}}</del></span>
                                     @else
                                         {{$course->fees}}
                                     @endif
                                </td>
                                <td class="px-6 py-4">
                                     @if ($course->image)
                                         <img src="{{ asset('storage/'.$course->image)}}" width="50" alt="course image">
                                     @else
                                         <img src="{{ asset('storage/default-course.jpg')}}" width="50" alt="course image">
                                     @endif
                                </td>
                                <td>
                                     {{ $course->duration}} Week
                                     @if ($course->duration > 1)
                                         ({{ $course->duration }} Weeks)
                                     @endif
                                </td>
                                <td>
                                     <a href="{{ route('course.edit', $course->id)}}"
                                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Edit
                                    </a>
                                     <form action="{{ route('course.destroy', $course->id)}}" method="POST" class="inline-flex">
                                        @csrf 
                                        @method('delete')
                                        <button type="submit" name="delete" class="px-3 py-3 text-sm font-medium text-white bg-red-500" value="X">
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
