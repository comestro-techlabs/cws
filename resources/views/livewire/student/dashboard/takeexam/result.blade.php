<div>
    <div class="container mt-24 px-4">
        @if (session('error'))
            <div class="alert alert-danger mb-4 bg-red-100 text-red-800 p-4 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-semibold mb-4">Result for Attempt {{ $attempt }}</h2>
        <p class="text-lg mb-6"><strong>Total Marks:</strong> {{ $totalMarks }}</p>

        <h4 class="text-xl font-semibold mt-4">Detailed Feedback:</h4>
        <div class="result-details mb-6 p-4 border-l-4">
            @if ($attempt == 1)
                <p class="text-lg"><strong>Your first attempt was evaluated. </strong>
                    <span class="text-gray-600">Good luck on your second attempt!</span>
                </p>
            @else
                <p class="text-lg"><strong>We recommend reviewing your results and trying again.</strong> 
                    Please check for any improvement areas.</p>
            @endif
        </div>

        {{-- Display the results --}}
        <div class="mt-4">
            <h5 class="font-semibold">Your Answers:</h5>
            @foreach ($results as $result)
                <div class="result-item mb-2">
                    <p><strong>Question:</strong> {{ $result->question->text }}</p>
                    <p><strong>Your Answer:</strong> {{ $result->answer }}</p>
                    <p><strong>Correct Answer:</strong> {{ $result->question->correct_answer }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
