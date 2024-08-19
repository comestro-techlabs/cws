@extends('public.layout')


@section('content')
    @include('public.carousel')

    <div class="grid grid-cols-5">
        @foreach ($courses as $course)
                <x-course-card :course="$course"/>
        @endforeach
    </div>
@endsection 