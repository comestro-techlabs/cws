<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapters for Course</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-semibold text-center">Chapters for Course</h1>

        <!-- Check if there are chapters -->
        @if($chapters->isEmpty())
            <p class="text-center text-red-500">No chapters available for this course.</p>
        @else
            <!-- <div class="space-y-5">
                @foreach($chapters as $chapter)
                    <div class="bg-white p-5 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold">{{ $chapter->chapter_name }}</h2>
                        <p class="mt-2 text-gray-700">{{ $chapter->chapter_description }}</p>
                        <p class="mt-2 text-gray-500">Order: {{ $chapter->order ?? 'N/A' }}</p>
                        <p class="mt-2 text-gray-500">Slug: {{ $chapter->chapter_slug }}</p>
                    </div>
                @endforeach
            </div> -->
            <table class="min-w-full bg-white border border-gray-300 shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Chapter Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">order</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chapters as $chapter)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $chapter->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $chapter->chapter_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $chapter->chapter_description }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $chapter->order ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-sm">
                                <a href="{{ route('chapters.show', $chapter->id) }}" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
