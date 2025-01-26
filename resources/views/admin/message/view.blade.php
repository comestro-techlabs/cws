@extends('admin.base')

@section('title', 'View Message')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="md:text-xl text-lg font-semibold dark:text-slate-300 text-slate-500 border-s-4 border-s-blue-800 pl-3">
        Messages Details </h2>
    <div class="bg-gray-100 p-6 rounded mt-4">
        <p class="mb-4"><strong>Title:</strong> {{ $message->title }}</p>
        <p class="mb-4"><strong>Content:</strong> {{ $message->content }}</p>
        <p class="mb-4"><strong>Recipient Type:</strong> {{ ucfirst($message->recipient_type) }}</p>

        <div class="mb-4">
            <strong>Recipients:</strong>
            @if (count($recipientDetails ?? []) > 0)
                <div class="border border-gray-300 rounded max-h-64 overflow-y-auto mt-4 w-full md:w-full lg:w-1/2">
                    <table class="min-w-full text-left text-sm text-gray-500">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($recipientDetails as $recipient)
                                <tr>
                                    <td class="px-4 py-2">{{ $recipient->name }}</td>
                                    <td class="px-4 py-2">{{ $recipient->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600 mt-2">No recipients found.</p>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('messages.manage') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
                Back to Messages
            </a>
        </div>
    </div>
</div>
@endsection
