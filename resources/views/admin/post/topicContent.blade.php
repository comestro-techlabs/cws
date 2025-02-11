<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts for Topic {{ $topicId }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10 p-4 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">Posts for Topic ID: {{ $topicId }}</h1>

        @if($posts->isEmpty())
            <p class="text-center text-gray-500">No posts found for this topic.</p>
        @else
            <div class="space-y-4">
                @foreach($posts as $post)
                    <div class="p-4 bg-gray-50 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-blue-600">{{ $post->title }}</h2>
                        <p class="text-gray-700 mt-2">{{ Str::limit($post->content, 150) }}</p>
                        
                        @if($post->image_path)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="max-w-full h-auto rounded-lg">
                            </div>
                        @endif
                        
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('topics.show', $post->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">Read More</a>
                            <span class="text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
