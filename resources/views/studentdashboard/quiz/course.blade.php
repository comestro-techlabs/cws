@extends('studentdashboard.include.base')

@section('content')

<div class="container mx-auto mt-10 px-4 py-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Your Courses</h1>

    @foreach ($courses as $course)
        <div class="bg-white border border-gray-300 shadow-md rounded-lg p-8 mb-4 hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-xl font-bold text-gray-800">{{ $course->title }}</h2>
            <div class="flex justify-between">
                <a  href="{{ route('student.quiz', ['courseId' => $course->id]) }}" ><button type="button"
                    class="px-3 py-2 text-xs rounded-2xl font-medium text-white bg-gradient-to-r from-blue-700 to-blue-400 mt-5">
                    Take quiz
                </button> </a>
                <a href="{{ route('student.allAttempts', $course->id) }}" ><button type="button"
                    class="px-3 py-2 text-xs rounded-2xl font-medium text-white bg-gradient-to-r from-green-700 to-green-400 mt-5">
                    See Result
                </button></a>
            </div>  
        </div>
    @endforeach
</div>

@if(session('message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('message') }}",
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection
