<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $assignment->title }} Review</h1>
    
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
                                   wire:model="grade.{{ $studentId }}" 
                                   class="border rounded px-2 py-1 w-16"
                                   maxlength="2">
                            @error("grade.$studentId") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
    @if($selectedFileId && $previewContent)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded-lg w-11/12 max-w-4xl h-5/6 relative overflow-auto">
                <button wire:click="$set('selectedFileId', null)"
                        class="absolute top-2 right-2 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                    Close
                </button>
                <h2 class="text-lg font-semibold mb-4">File Preview</h2>
                @if($previewMimeType)
                    @if(in_array($previewMimeType, ['image/jpeg', 'image/png', 'image/jpg']))
                        <img src="data:{{ $previewMimeType }};base64,{{ $previewContent }}"
                             alt="Preview" class="max-w-full max-h-[80%] object-contain mx-auto">
                    @elseif($previewMimeType === 'application/pdf')
                        <object data="data:application/pdf;base64,{{ $previewContent }}"
                                type="application/pdf" class="w-full h-[80%]">
                            <p>Preview not available. </p>
                        </object>
                    @else
                        <p class="text-gray-600">Preview not supported for this file type. 
                            
                        </p>
                    @endif
                @endif
            </div>
        </div>
    @endif
</div>