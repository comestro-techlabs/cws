@extends('admin.base')

@section('title', 'Add Assignment | ')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white">
    <!-- Profile Section -->
    <div class="flex items-center space-x-4 mb-6">
        {{-- <img src="https://via.placeholder.com/80" alt="Profile Image" class="w-20 h-20 rounded-full"> --}}
        <div>
            <h1 class="text-2xl font-bold">{{$student->name}}</h1>
        </div>
    </div>

    <!-- Filter Dropdown -->
    {{-- <div class="mb-6">
        <select class="border border-gray-300 rounded-lg py-2 px-4 w-full sm:w-1/3">
            <option value="all">All</option>
            <option value="completed">Completed</option>
            <option value="pending">Pending</option>
        </select>
    </div> --}}

    <!-- Assignments Section -->
    <div class="space-y-4">
    
        <!-- Single Assignment with Upload Count -->
        @foreach($assignments as $assignment)
        <div class="flex items-center justify-between border-b py-4">
            <div>
                <p class="text-lg font-medium flex items-center">
                    {{ \Illuminate\Support\Str::words($assignment->assignment->title, 13) }}
                  
                </p>
                <p class="text-sm text-gray-500">No due date</p>
            </div>
            @if($assignment->grade)
            <p class="text-gray-500 font-medium group relative inline-block">
                {{ $assignment->grade }}
                <span class="opacity-0 group-hover:opacity-100 transition-opacity text-gray-400">
                    /100
                </span>
            </p>
            
        @else
        <p class="text-gray-500 font-medium">Not graded yet</p> 
        @endif
            
        </div>
        @endforeach
    </div>
</div>

@endsection
