<!-- resources/views/livewire/student/take-test.blade.php -->
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar with Question Navigation -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h5 class="text-xl font-bold mb-4 text-gray-800">Questions</h5>
                <div class="space-y-2">
                    @foreach($questions as $index => $question)
                        <button 
                            wire:click="goToQuestion({{ $index }})"
                            class="w-full text-left py-2 px-3 rounded transition duration-300
                                {{ $currentQuestionIndex === $index ? 'bg-blue-500 text-white' : '' }}
                                {{ isset($answers[$question['id']]) ? 'bg-green-500 hover:bg-green-600 text-white' : 'bg-red-500 hover:bg-red-600 text-white' }}
                                {{ $submitted ? 'cursor-not-allowed opacity-50' : '' }}"
                            @if($submitted) disabled @endif
                        >
                            Question {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Question Area -->
        <div class="md:col-span-3">
            @if(count($questions) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h5 class="text-2xl font-bold mb-4 text-gray-800">Question {{ $currentQuestionIndex + 1 }}</h5>
                    <p class="text-gray-700 mb-6">{{ $questions[$currentQuestionIndex]['question'] }}</p>
                    
                    @php
                        $options = json_decode($questions[$currentQuestionIndex]['options'], true);
                    @endphp
                    
                    <div class="space-y-4">
                        @foreach($options as $option)
                            <label class="flex items-center space-x-3 {{ $submitted ? 'cursor-not-allowed opacity-50' : '' }}">
                                <input 
                                    type="radio" 
                                    class="form-radio h-5 w-5 text-blue-600"
                                    name="answer"
                                    wire:model.debounce.500ms="answers.{{ $questions[$currentQuestionIndex]['id'] }}"
                                    value="{{ $option }}"
                                    @if($submitted) disabled @endif
                                >
                                <span class="text-gray-700">{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-between">
                        <div>
                            <button 
                                wire:click="previousQuestion" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300
                                    {{ $submitted ? 'cursor-not-allowed opacity-50' : '' }}"
                                @if($currentQuestionIndex === 0 || $submitted) disabled @endif
                            >
                                Previous
                            </button>
                            <button 
                                wire:click="nextQuestion" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300 ml-2
                                    {{ $submitted ? 'cursor-not-allowed opacity-50' : '' }}"
                                @if($currentQuestionIndex === count($questions) - 1 || $submitted) disabled @endif
                            >
                                Next
                            </button>
                        </div>
                        <button 
                            wire:click="submitTest" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300
                                {{ $submitted ? 'cursor-not-allowed opacity-50' : '' }}"
                            @if($submitted) disabled @endif
                        >
                            {{ $submitted ? 'Submitted' : 'Submit Test' }}
                        </button>
                    </div>

                    @if($submitted)
                        <div class="mt-4 p-4 bg-green-100 rounded-lg">
                            <p class="text-green-700">Test has been submitted successfully!</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>