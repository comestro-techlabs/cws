<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Courses</h1>

        <!-- Display courses if there are any -->
        @if($courses->isEmpty())
            <p class="text-center text-lg text-gray-600">No courses available.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300 shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $course->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $course->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $course->description }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $course->status ? 'Active' : 'Inactive' }}</td>
                            <td class="px-4 py-2 text-sm">
                                <a href="{{ route('courses.show', $course->id) }}" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">View</a>
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
