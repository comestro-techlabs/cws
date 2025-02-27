<div>
<div class="container mx-auto py-8 mt-12">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Manage Assignments</h1>
        <!-- Check if Courses Exist -->
        @if ($courses->isNotEmpty())

            @foreach ($courses as $course)
                <div class="mb-8">
                    <!-- Course Title -->
                    <div class="bg-teal-600 text-white px-6 py-4 rounded-t-lg">
                        <h2 class="text-lg font-semibold">{{ $course->title }}</h2>
                    </div>

                    <!-- Assignments Table -->
                    <div class="bg-white shadow-md rounded-b-lg overflow-hidden">
                        <table class="w-full border-collapse">
                            <thead class="bg-gray-200 text-gray-700">
                                <tr>
                                    <th class="py-4 px-6 text-left font-medium">ID</th>
                                    <th class="py-4 px-6 text-left font-medium">Title</th>
                                    <th class="py-4 px-6 text-left font-medium">Description</th>
                                    <th class="py-4 px-6 text-center font-medium">Status</th>
                                    <th class="py-4 px-6 text-center font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->assignments as $key => $assignment)
                                    <tr class="hover:bg-gray-100 border-t border-gray-200">
                                        <td class="py-4 px-6 text-gray-800">{{ $key + 1 }}</td>
                                        <td class="py-4 px-6 text-gray-800">{{ $assignment->title }}</td>
                                        <td class="py-4 px-6 text-gray-600">
                                            {!! Str::limit($assignment->description, 50) !!}
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if ($assignment->uploads->isNotEmpty())
                                                @foreach ($assignment->uploads as $upload)
                                                    <span class="px-3 py-1 inline-block rounded-lg text-white
                                                        @if ($upload->status == 'submitted') bg-green-500
                                                        @elseif($upload->status == 'graded') bg-blue-500
                                                        @else bg-gray-500 @endif">
                                                        {{ ucfirst($upload->status) }}
                                                    </span><br>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">No uploads</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <a href="{{ route('student.assignment-upload', $assignment->id) }}"
                                               class="inline-block text-blue-600 hover:text-blue-800 font-medium">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        {{-- <td colspan="5" class="px-4 py-3 border text-center text-gray-500">
                                            No assignments available for this course.
                                        </td> --}}
                                        <td colspan="5" class="px-4 py-3 border text-center">
                                            <div class="flex flex-col items-center py-8">
                                                <img src="https://tse4.mm.bing.net/th?id=OIP.fqgd7Ij7CDhGwPwro_SsiQAAAA&pid=Api&P=0&h=180" alt="No Assignments"
                                                     class="w-32 h-32 mb-4">
                                                <p class="text-xl font-semibold text-gray-600">No assignments available for this course.</p>
                                                <p class="text-gray-500">Stay tuned for upcoming assignments.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">No courses available for the logged-in student.</p>
        @endif
    </div>
</div>
