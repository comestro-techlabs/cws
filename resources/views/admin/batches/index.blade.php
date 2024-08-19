@extends('admin.base')

@section('content')
    <div class="max-w-7xl mx-auto mt-4 p-2 sm:px-6 lg:px-8">

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

       
<div class="flex flex-row flex-1 gap-3 ">
    
        <!-- Display Batches -->
        <div class="flex-1 p-3 shadow-md h-[600px] overflow-y-scroll">
            <h2 class="text-xl font-medium text-gray-800 mb-4">Existing Batches</h2>
            <div class="grid grid-cols-2 gap-2">
                @foreach($batches as $batch)
            <div class="mb-6 p-3 bg-gradient-to-r from-purple-500 to-indigo-500 text-white border border-indigo-600 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold">{{ $batch->batch_name }}</h3>
                <p class="text-lg">
                    Course: <span class="font-semibold">{{ $batch->course->title }}</span>
                </p>
                <div class="grid grid-cols-2 gap-1 mt-2">
                
                <p class="text-xs flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M5.75 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM5 10.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM10.25 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM7.25 8.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM8 9.5A.75.75 0 1 0 8 11a.75.75 0 0 0 0-1.5Z" />
                        <path fill-rule="evenodd" d="M4.75 1a.75.75 0 0 0-.75.75V3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2V1.75a.75.75 0 0 0-1.5 0V3h-5V1.75A.75.75 0 0 0 4.75 1ZM3.5 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v4.5a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V7Z" clip-rule="evenodd" />
                      </svg>
                      
                    Start: <span class="font-medium">{{ \Carbon\Carbon::parse($batch->start_date)->format('F j, Y') }}</span>
                </p>
                <p class="text-xs flex gap-1 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path d="M5.75 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM5 10.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM10.25 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM7.25 8.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM8 9.5A.75.75 0 1 0 8 11a.75.75 0 0 0 0-1.5Z" />
                        <path fill-rule="evenodd" d="M4.75 1a.75.75 0 0 0-.75.75V3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2V1.75a.75.75 0 0 0-1.5 0V3h-5V1.75A.75.75 0 0 0 4.75 1ZM3.5 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v4.5a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V7Z" clip-rule="evenodd" />
                      </svg> End: <span class="font-light">{{ \Carbon\Carbon::parse($batch->end_date)->format('F j, Y') }}</span>
                </p>
                <p class="text-xs">
                    Total Seats: <span class="font-light">{{ $batch->total_seats }}</span>
                </p>
                <p class="text-xs">
                    Available Seats: <span class="font-light">{{ $batch->available_seats }}</span>
                </p>
               </div>
                <div class="mt-2 flex space-x-4">
                    <!-- Delete Button -->
                    <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this batch?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                    <!-- Disable Button -->
                   
                </div>
            </div>
            @endforeach
            </div>
        </div>

        <!-- Add New Batch Form -->
        <div class="p-3 bg-yellow-50 border border-yellow-300 shadow-md rounded-md flex-[0.5]">
            <h2 class="text-xl font-medium text-gray-800 mb-4">Add New Batch</h2>
            <form action="{{ route('batches.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Course Selection -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700">Course:</label>
                    <select name="course_id" id="course_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Batch Name -->
                <div>
                    <label for="batch_name" class="block text-sm font-medium text-gray-700">Batch Name:</label>
                    <input type="text" name="batch_name" id="batch_name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                    <input type="date" name="end_date" id="end_date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Total Seats -->
                <div>
                    <label for="total_seats" class="block text-sm font-medium text-gray-700">Total Seats:</label>
                    <input type="number" name="total_seats" id="total_seats" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Available Seats -->
                <div>
                    <label for="available_seats" class="block text-sm font-medium text-gray-700">Available Seats:</label>
                    <input type="number" name="available_seats" id="available_seats" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Batch
                    </button>
                </div>
            </form>
        </div>
</div>
    
    </div>
@endsection
