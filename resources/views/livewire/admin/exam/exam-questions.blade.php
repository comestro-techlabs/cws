<div>
    <div class="p-6 bg-white rounded-lg shadow-md mt-12">
        <div class="mb-6">
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">{{ $exam->exam_name }} Questions</h2>
            <p class="text-gray-600">Course: {{ $exam->course->title }}</p>
        </div>

        <!-- Search Section -->
        <div class="flex justify-between items-center mb-6">
            <div class="w-1/3">
                <input wire:model.live="search" type="text" placeholder="Search questions..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <a href="{{ route('admin.quiz', ['examId' => $exam->id]) }}" 
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Add New Question
            </a>
        </div>

        <!-- Questions List -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Options</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correct Answer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($questions as $question)
                    <tr>
                        <td class="px-6 py-4">{{ $question->question }}</td>
                        <td class="px-6 py-4">
                            <ul class="list-disc list-inside">
                                <li>{{ $question->option1 }}</li>
                                <li>{{ $question->option2 }}</li>
                                <li>{{ $question->option3 }}</li>
                                <li>{{ $question->option4 }}</li>
                            </ul>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $question->{$question->correct_answer} }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-sm {{ $question->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $question->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $questions->links() }}
        </div>
    </div>
</div>
