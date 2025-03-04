
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center mb-6">
        
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 ">{{ $course->title }} ({{ $batchName }})  Review</h2>
        <button onclick="window.history.back()"
        class="mb-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
     Go Back
    </button> 
    </div>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploads</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                
                @foreach($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $student['user']->name }}</td>
                        <td class="px-6 py-4">{{ $student['upload_count'] }}</td>
                        <td class="px-6 py-4">{{ $student['grade'] ?? 'Not Graded' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                            <a href="{{ route('assignment.reviewWork', $student['user']->id) }}" class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-500 transition flex items-center gap-1">View Details </a>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>