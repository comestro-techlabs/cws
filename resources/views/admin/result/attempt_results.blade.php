@extends('admin.base')

@section('content')

<div class="max-w-6xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center p-4 mb-6">
        
    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold ">Results for {{ $user->name }} in Exam: {{ $exam->exam_name }}</h3>
    <button onclick="history.back()" class="px-4 py-2 ml-4 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
        Go Back
    </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full bg-white border-collapse border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm sm:text-base font-semibold text-gray-700 border-b border-gray-300">Attempt</th>
                    <th class="px-4 py-2 text-left text-sm sm:text-base font-semibold text-gray-700 border-b border-gray-300">Total Marks</th>
                    <th class="px-4 py-2 text-left text-sm sm:text-base font-semibold text-gray-700 border-b border-gray-300">Actions</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach($attempts as $attempt)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm sm:text-base text-gray-600 border-b border-gray-200">{{ $attempt->attempt }}</td>
                    <td class="px-4 py-2 text-sm sm:text-base text-gray-600 border-b border-gray-200">{{ $attempt->total_marks }}</td>
                    <td class="px-4 py-2 text-sm sm:text-base border-b border-gray-200">
                        <a href="{{ route('attempt.details', ['examId' => $exam->id, 'userId' => $user->id, 'attempt' => $attempt->attempt]) }}" class="inline-block px-4 py-2 text-sm sm:text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg  transition duration-200 ease-in-out transform hover:scale-105">
                            View Details
                        </a>
                        <a href="{{ route('certificate', ['examId' => $exam->id, 'userId' => $user->id, 'attempt' => $attempt->attempt]) }}" target="_blank" class="inline-block px-4 py-2 ml-2 text-sm sm:text-base font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                            View Certificate
                        </a>
                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
