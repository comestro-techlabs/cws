<div class="container mx-auto px-4 py-8">
    <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center mb-6">
        
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 ">{{ $assignment->title }} Review</h2>
            <button onclick="window.history.back()"
            class="mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        Go Back
    </button>        
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Files</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submitted Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Current Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">New Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($students as $studentId => $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $student['name'] }}</td>
                        <td class="px-6 py-4">
                            @foreach($student['uploads'] as $upload)
                                <button wire:click="previewFile('{{ $upload->file_path }}')"
                                        class="text-blue-600 hover:text-blue-800 mr-2">
                                    Preview {{ $loop->iteration }}
                                </button>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">{{ $student['submitted_at'] }}</td>
                        <td class="px-6 py-4">{{ $student['grade'] ?? 'Not Graded' }}/100</td>
                        <td class="px-6 py-4">
                            <input type="text" 
                                   wire:model.lazy="grade.{{ $studentId }}" 
                                   class="border rounded px-2 py-1 w-16"
                                   maxlength="3">
                            @error("grade.$studentId") 
                                <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="insertGrade('{{ $studentId }}')"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Grade
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for File Preview -->
    @if($selectedFileId)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded-lg w-11/12 max-w-4xl h-5/6 relative overflow-auto">
                <button wire:click="closePreview"
                        class="absolute top-2 right-2 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                    Close
                </button>
                <h2 class="text-lg font-semibold mb-4">File Preview</h2>
                
                <iframe src="https://drive.google.com/file/d/{{ $selectedFileId }}/preview"
                        class="w-full h-[80%] border"></iframe>
            </div>
        </div>
    @endif
</div>
