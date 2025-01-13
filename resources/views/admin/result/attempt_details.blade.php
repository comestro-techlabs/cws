@extends('admin.base')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-md md:texl-xl lg:text-2xl  font-bold">Detailed Results for {{ $user->name }} in Exam: {{ $exam->exam_name }} (Attempt {{ $attempt }})</h3>
        
    </div>

    <div id="results-section" class="space-y-6">
        @foreach($answers as $answer)
        <div class="border rounded-lg p-4  bg-white">
            <div class="flex justify-between mb-4">
                <p class="text-lg font-semibold">Question ID: {{ $answer->quiz->id }}</p>
                <p class="text-sm text-gray-500">Status: <span class="font-medium">{{ $answer->selected_option == $answer->quiz->correct_answer ? 'Correct' : 'Incorrect' }}</span></p>
            </div>

            <p class="font-medium text-gray-700">{{ $answer->quiz->question }}</p>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex items-start">
                    <span class="mr-2 font-semibold">1.</span>
                    <p>{{ $answer->quiz->option1 }}</p>
                </div>
                <div class="flex items-start">
                    <span class="mr-2 font-semibold">2.</span>
                    <p>{{ $answer->quiz->option2 }}</p>
                </div>
                <div class="flex items-start">
                    <span class="mr-2 font-semibold">3.</span>
                    <p>{{ $answer->quiz->option3 }}</p>
                </div>
                <div class="flex items-start">
                    <span class="mr-2 font-semibold">4.</span>
                    <p>{{ $answer->quiz->option4 }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-6">
                <div>
                    <p class="text-sm">
                        <span class="font-medium text-gray-700">Selected Option:</span> 
                        <span class="font-bold text-blue-600">{{ ucfirst($answer->selected_option) }}</span>
                    </p>
                    <p class="text-sm">
                        <span class="font-medium text-gray-700">Correct Option:</span> 
                        <span class="font-bold text-green-600">{{ ucfirst($answer->quiz->correct_answer) }}</span>
                    </p>
                </div>
                <div>
                    <p class="text-sm">
                        <span class="font-medium text-gray-700">Marks Obtained:</span> 
                        <span class="font-bold text-purple-600">{{ $answer->obtained_marks }}</span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-end mt-4">
        <button onclick="history.back()" class="px-4 py-2   float-end bg-gray-500 text-white rounded-lg  hover:bg-gray-600 transition mr-4">
            Go Back
        </button>
        <button onclick="printResults()" class="px-4 py-2 bg-blue-500 text-white rounded-lg  hover:bg-blue-600 transition">
            Print Results
        </button>
    </div>
    
</div>

<style>
    /* Hide everything except the results section during printing */
    @media print {
        body * {
            visibility: hidden; /* Hide all elements */
        }

        #results-section, #results-section * {
            visibility: visible; /* Show the results section */
        }

        #results-section {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        /* Hide the Print and Go Back buttons */
        button {
            display: none;
        }
    }
</style>

<script>
    function printResults() {
        window.print(); // Directly opens the print dialog for the current page
    }
</script>
@endsection
