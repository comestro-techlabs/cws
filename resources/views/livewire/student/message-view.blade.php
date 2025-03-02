<div class="container mx-auto px-6 py-8">
    <a wire:navigate href="{{ route('student.messages') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        ← Back to Notifications
    </a>

    <div class="bg-gray-50 p-8 rounded-lg max-w-2xl mx-auto mt-6">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $message->title }}</h1>
            <div class="border-t-2 border-gray-300 mt-2 w-16 mx-auto"></div>
        </div>

        <div class="prose max-w-none text-gray-700">
            <p>{{ $message->content }}</p>
        </div>

        <div class="text-sm text-gray-500 mt-4 text-right">
            <p>Received on: {{ $message->created_at->format('M d, Y H:i A') }}</p>
        </div>
    </div>
</div>