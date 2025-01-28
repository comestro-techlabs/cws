@extends('studentdashboard.include.base')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">Your Messages</h1>

    @if($messages->isEmpty())
        <div class="bg-gray-100 p-6 rounded-lg text-center">
            <p class="text-gray-600">You have no messages.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($messages as $message)
                <div class="border border-gray-300 rounded-lg p-6 bg-white hover:bg-gray-50 transition duration-300 ease-in-out">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 leading-tight break-words">
                        {{ $message->title }}
                    </h2>
                    <p class="text-gray-700 mb-4 text-base leading-relaxed break-words">
                        {{ $message->content }}
                    </p>
                    <div class="text-sm text-gray-500">
                        Sent on: {{ $message->created_at->format('M d, Y H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
   
    @media (max-width: 640px) {
        .container {
            padding: 1rem;
        }
        h1 {
            font-size: 1.5rem;
        }
        .text-base {
            font-size: 0.9rem;
        }
    }
</style>
@endsection 
