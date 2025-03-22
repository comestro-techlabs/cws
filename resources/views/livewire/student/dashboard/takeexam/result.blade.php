<div class="container mx-auto p-4">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800">Percentage</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['percentage'] }}%</p>
        </div>
        
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Marks</h3>
            <p class="text-2xl font-bold text-green-600">{{ $stats['marks'] }}</p>
        </div>
        
        <div class="bg-emerald-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-emerald-800">Correct Answers</h3>
            <p class="text-2xl font-bold text-emerald-600">{{ $stats['correct'] }}</p>
        </div>
        
        <div class="bg-red-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-red-800">Incorrect Answers</h3>
            <p class="text-2xl font-bold text-red-600">{{ $stats['incorrect'] }}</p>
        </div>
    </div>

    <!-- Detailed Answer Sheet -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Detailed Answer Sheet</h2>
        
        <div class="space-y-6">
            @foreach($answers as $index => $answer)
                <div class="border-b pb-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-semibold">Question {{ $index + 1 }}</h3>
                        <span class="text-sm font-medium {{ $answer->obtained_marks > 0 ? 'text-green-600' : 'text-red-600' }}">
                            Marks: {{ $answer->obtained_marks }}
                        </span>
                    </div>

                    <p class="text-gray-700 mb-2">
                        Question: {{ $answer->quiz->question ?? 'Question not available' }}
                    </p>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <p class="text-sm text-gray-600">Selected Answer:</p>
                            <p class="font-medium">{{ $answer->selected_option }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Correct Answer:</p>
                            <p class="font-medium text-green-600">
                                {{ $answer->quiz->correct_answer ?? 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Options:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach(['option1', 'option2', 'option3', 'option4'] as $option)
                                <li class="{{ $answer->selected_option === $option ? 'font-bold' : '' }} 
                                    {{ $answer->quiz->correct_answer === $option ? 'text-green-600' : '' }}">
                                    {{ $answer->quiz->$option ?? 'N/A' }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>