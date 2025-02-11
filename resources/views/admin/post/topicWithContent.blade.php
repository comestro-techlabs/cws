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
        <h1 class="text-3xl font-semibold text-center">Topic for Chapter</h1>

        <!-- Check if there are chapters -->
        @if($topics->isEmpty())
            <p class="text-center text-red-500">No topic available for this chapter</p>
        @else
            
            <table class="min-w-full bg-white border border-gray-300 shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Topic Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topics as $topic)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $topic->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $topic->topic_name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $topic->topic_description }}</td>
                            <td class="px-4 py-2 text-sm">
                                <a href="" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
