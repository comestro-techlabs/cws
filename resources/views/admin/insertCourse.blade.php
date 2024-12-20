@extends('admin.base')


@section('title', 'Insert Course | ')


@section('content') 
        <div class="flex gap-3   mt-5  px-[2%] flex-row justify-between items-center">

            <h2 class="md:text-xl text-lg font-semibold dark:text-slate-300 text-slate-500 border-s-4 border-s-orange-400 pl-3">
                Insert Course</h2>

            <div class="inline-flex flex-row  md:items-center gap-2" role="group">
                
                <a href="{{ route('course.index') }}"
                    class="px-3 py-2 bg-teal-500 rounded-lg text-white self-start">
                    View All Courses
                </a>
            </div>

        </div>
        <div class="flex flex-1 flex-col px-[2%] w-full justify-center items-center">
            <x-insert-course/>
        </div>
@endsection
