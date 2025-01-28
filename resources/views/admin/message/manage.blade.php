@extends('admin.base')

@section('title', 'Manage Message')
@section( 'content')

<div class="container mx-auto py-8">
    <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-blue-800 pl-3">
        Messages </h2>
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b">Title</th>
                    <th class="px-6 py-3 border-b">Recipient Type</th>
                    <th class="px-6 py-3 border-b">Created At</th>
                    <th class="px-6 py-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr class="text-center">
                        <td class="px-6 py-3 border-b">{{ $message->title }}</td>
                        <td class="px-6 py-3 border-b">{{ ucfirst($message->recipient_type) }}</td>
                        <td class="px-6 py-3 border-b">{{ $message->created_at->format('d M, Y') }}</td>
                        <td class="px-6 py-3 border-b ">
                            <div class="flex gap-2 item-center justify-center">
                             <a href="{{ route('messages.show', $message) }}" class="bg-blue-500 text-white py-1 px-4 rounded-lg  ">View</a> |
                            <form action="{{ route('messages.delete', $message) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded-lg">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection
