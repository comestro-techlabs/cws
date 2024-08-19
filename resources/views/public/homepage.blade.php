@extends('public.layout')


@section('content')
    <x-hero/>

    

    <div class="grid md:grid-cols-4 px-3 md:px-10 gap-5 grid-cols-1 py-5 bg-white">
        @foreach ($courses as $course)
                <x-course-card :course="$course"/>
        @endforeach
    </div>
@endsection 