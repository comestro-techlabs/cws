<div class="p-6">
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif
        </div>

        <!-- Total Marks Card -->
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Total Marks</h3>
            <p class="text-3xl font-bold text-green-600">{{ $examUser->total_marks }}</p>
        </div>

        <!-- Correct Answers Card -->
        <div class="bg-emerald-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-emerald-800">Correct Answers</h3>
            <p class="text-3xl font-bold text-emerald-600">{{ $correctAnswers }}</p>
        </div>

        <!-- Incorrect Answers Card -->
        <div class="bg-red-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-red-800">Incorrect Answers</h3>
            <p class="text-3xl font-bold text-red-600">{{ $incorrectAnswers }}</p>
        </div>
    </div>

    <!-- Detailed Answer Sheet -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Detailed Answer Sheet</h2>
        
        @foreach($answers as $answer)
        <div class="border-b py-4 last:border-0">
            <div class="mb-2">
                <span class="font-semibold">Q{{ $loop->iteration }}.</span>
                <span>{{ $answer->quiz->question }}</span>
            </div>
            
            <div class="grid grid-cols-2 gap-4 ml-6">
                @foreach(['option1', 'option2', 'option3', 'option4'] as $option)
                    <div class="@if($option == $answer->quiz->correct_option && $option == $answer->selected_option) 
                                bg-green-100
                              @elseif($option == $answer->selected_option && $option != $answer->quiz->correct_option)
                                bg-red-100
                              @elseif($option == $answer->quiz->correct_option)
                                bg-green-50
                              @endif p-2 rounded">
                        {{ $answer->quiz->$option }}
                        @if($option == $answer->quiz->correct_option)
                            <span class="text-green-600 ml-2">✓</span>
                        @endif
                    </div>
                @endforeach
            </div>
            
            <div class="mt-2 ml-6">
                <span class="font-medium">Marks Obtained:</span>
                <span class="@if($answer->obtained_marks > 0) text-green-600 @else text-red-600 @endif">
                    {{ $answer->obtained_marks }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>