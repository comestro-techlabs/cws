@extends('admin/base')

@section('title', 'Manage Course |')

@section('content')
    <div class="flex flex-1 flex-col">
        <div class="md:px-[2%] px-5 py-5">
            <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center">

                <h2 class="md:text-xl text-lg font-semibold dark:text-slate-300 text-slate-500 border-s-4 border-s-orange-400 pl-3">@if(isset($_GET['search']) && $_GET['search'] !== "")
                    {{$_GET['search']}}
                @else 
                    {{"Manage all"}}
                @endif Courses ({{count($courses)}})</h2>


                {{-- search form starts here --}}
                
                {{-- search form ends here --}}


                <div class="inline-flex md:flex-row flex-col  md:items-center gap-2" role="group">
                    <form action="{{ route('course.search') }}" method="get" class=" md:max-w-md md:mx-auto">
                   
                        <div class="flex border rounded-lg ps-3">
                           
                            <input type="search" id="default-search" name="search"
                                value="{{old('search')}}"
                                class="border-0 focus:outline-none focus:border-none w-full"
                                placeholder="Search course by name..." size="30"  />
                            <button type="submit"
                                class="bg-slate-100 px-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg></button>
                        </div>
                    </form>
                    <a href="{{ route('course.create') }}"
                        class="px-3 py-2 bg-teal-600 rounded-lg text-white self-start">
                        Add Course
                    </a>
                </div>

            </div>
            <div class="relative overflow-x-auto flex-1 border dark:border-slate-500 mt-5">
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
                                Duration
                            </th>
                            <th scope="col" class="px-6 py-3">
                                IsPublished
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
                                <td class="px-6 py-4 text-slate-600">
                                    @if ($course->discounted_fees)
                                        {{ $course->discounted_fees }}
                                        <span class="text-slate-300"><del>{{ '₹' . number_format($course->discounted_fees, 2) }}</del></span>
                                    @else
                                        {{'₹' . number_format($course->fees, 2) }}
                                    @endif
                                </td>
                               
                                <td class="px-6 py-4">
                                    @if ($course->duration > 1)
                                        {{ $course->duration }} Weeks
                                    @else
                                        @if ($course->duration == 0)
                                            {{"NULL"}}
                                        @else:
                                            {{ $course->duration }} Week
                                        @endif
                                    @endif
                                </td>
                                <td class="px-3 py-4">
                                    {!!(!$course->published)? 
                                    "<span class='text-slate-100 bg-slate-600 text-xs px-2 py-1 rounded-xl'>Draft</span>" : 
                                    "<span class='text-slate-100 bg-teal-600 text-xs px-2 py-1 rounded-xl'>Published</span>"!!}
                                </td>
                                <td class="flex gap-2 items-center px-6 py-4">
                                    <a href="{{route('course.batches',$course->id)}}" class="px-3 py-2 bg-yellow-400 text-xs rounded-xl font-medium text-white">Batches</a>
                                    <a href="{{ route('course.show', $course->id) }}"
                                        class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500">
                                        Show
                                    </a>
                                    <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                        class="inline-flex items-center">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" name="delete"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500" value="X">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="flex flex-1 space-x-2 justify-center mt-2 pagination">
                {{$courses->links()}}
            </div>

        </div>
    @endsection
