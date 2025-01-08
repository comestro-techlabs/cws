@extends('admin.base')

@section('title', 'Add Assignment | ')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white">
    <!-- Profile Section -->
    <div class="flex items-center space-x-4 mb-6">
        <img src="https://via.placeholder.com/80" alt="Profile Image" class="w-20 h-20 rounded-full">
        <div>
            <h1 class="text-2xl font-bold">{{$student->name}}</h1>
        </div>
    </div>

    <!-- Filter Dropdown -->
    <div class="mb-6">
        <select class="border border-gray-300 rounded-lg py-2 px-4 w-full sm:w-1/3">
            <option value="all">All</option>
            <option value="completed">Completed</option>
            <option value="pending">Pending</option>
        </select>
    </div>

    <!-- Assignments Section -->
    <div class="space-y-4">
    
        <!-- Single Assignment with Upload Count -->
        <div class="flex items-center justify-between border-b py-4">
            <div>
                <p class="text-lg font-medium flex items-center">
                    gfdsg
                    <span class="ml-2 text-gray-500 flex items-center">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 106 0 3 3 0 00-6 0z" />
                            <path fill-rule="evenodd" d="M4 9a5 5 0 1110 0 5 5 0 01-10 0zm12 0a7 7 0 11-14 0 7 7 0 0114 0z" clip-rule="evenodd" />
                        </svg> --}}
                        1
                    </span>
                </p>
                <p class="text-sm text-gray-500">No due date</p>
            </div>
            <p class="text-gray-500 font-medium">25/100</p>
        </div>
    </div>
</div>

@endsection
