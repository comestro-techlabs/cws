<div class="container mx-auto px-4 py-8">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">Manage Results</h2>

        @if($viewMode !== 'exams')
            <button wire:click="goBack" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back
            </button>
        @endif
       
    </div>

    @if($viewMode === 'exams')
        <div class="mb-4">
            <input wire:model.live="search" type="text" placeholder="Search exams..." 
                   class="w-full max-w-md p-2 border border-gray-400 rounded ">
        </div>
        <div class="bg-white  rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Exam Name</th>
                        <th class="px-6 py-3 text-left">Course</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $exam)
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $exam->exam_name }}</td>
                            <td class="px-6 py-4">{{ $exam->course->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="showExamUsers({{ $exam->id }})" 
                                        class="bg-purple-800 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                                    View Users
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">{{ $exams->links() }}</div>
        </div>

    @elseif($viewMode === 'examUsers')
        <div class="bg-white  rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $exam->exam_name }} - Users</h2>
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">User Name</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examUsers as $examUser)
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $examUser->user->name }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="showAttempts({{ $exam->id }}, {{ $examUser->user->id }})" 
                                        class="bg-purple-800 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                                    View Attempts
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @elseif($viewMode === 'attempts')
        <div class="bg-white  rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $user->name }}'s Attempts for {{ $exam->exam_name }}</h2>
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Attempt #</th>
                        <th class="px-6 py-3 text-left">Total Marks</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attempts as $attempt)
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $attempt->attempt }}</td>
                            <td class="px-6 py-4">{{ $attempt->total_marks }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="showAttemptDetails({{ $exam->id }}, {{ $user->id }}, {{ $attempt->attempt }})" 
                                        class="bg-purple-800 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @elseif($viewMode === 'details')
        <div class="max-w-6xl mx-auto mt-10">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md md:text-xl lg:text-2xl font-bold">
                    Detailed Results for {{ $user->name }} in Exam: {{ $exam->exam_name }} (Attempt {{ $selectedAttempt }})
                </h3>
            </div>
    
            <div id="results-section" class="space-y-6">
                @foreach($answers as $answer)
                    <div class="border rounded-lg p-4 bg-white">
                        <div class="flex justify-between mb-4">
                            <p class="text-lg font-semibold">Question ID: {{ $answer->quiz->id }}</p>
                            <p class="text-sm text-gray-500">
                                Status: 
                                <span class="font-medium">
                                    {{ $answer->selected_option == $answer->quiz->correct_answer ? 'Correct' : 'Incorrect' }}
                                </span>
                            </p>
                        </div>
    
                        <p class="font-medium text-gray-700">{{ $answer->quiz->question ?? 'N/A' }}</p>
    
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
    
        </div>
    
    
    @endif
</div>