
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $course->title }} Review</h1>
    
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
                            
                            <a href="{{ route('assignment.reviewWork', $student['user']->id) }}"
                               class="text-blue-600 hover:text-blue-800">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>