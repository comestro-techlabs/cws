@extends('studentdashboard.include.base')

@section('content')
    <div class="container mx-auto px-6 lg:px-20 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Your Notifications</h1>

        @if ($sortmessages->isEmpty())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.25 5.75h1.5m-1.5 4.5h1.5m-1.5 4.5h1.5m-7.5-6v7.5c0 1.1.9 2 2 2h9c1.1 0 2-.9 2-2v-7.5c0-1.1-.9-2-2-2h-9c-1.1 0-2 .9-2 2z" />
                    </svg>
                    <p>No new messages at the moment.</p>
                </div>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($sortmessages as $message)
                    @php
                        $isRead = in_array($message->id, $readMessages);
                        $isFirstUnread = !$isRead && $loop->first;
                    @endphp

                    <a href="{{ route('student.messages.show', $message) }}"
                        class="block p-6 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out
                        {{ $isRead ? 'bg-white' : 'bg-blue-50 border-blue-200' }}
                        {{ $isFirstUnread ? 'ring-2 ring-blue-500' : '' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 {{ $isRead ? 'text-gray-500' : 'text-blue-500' }}"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H7" />
                            </svg>
                            <h2 class="text-lg font-semibold {{ $isRead ? 'text-gray-800' : 'text-blue-800' }}">
                                {{ $message->title }}</h2>
                        </div>
                        <p class="text-gray-600 mt-2">{{ Str::limit($message->content, 100) }}</p>
                        <p class="text-sm text-gray-500 mt-2">Received on:
                            {{ $message->created_at->format('M d, Y H:i A') }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
