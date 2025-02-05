@extends('admin.base')

@section('title', 'Message')



@section('content')
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
<div class="container mx-auto p-6">
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Create New Message</h2>
    </div>
    <form action="{{ route('messages.store') }}" method="POST" class="mt-6">
        @csrf

        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" name="title" class="w-full border-gray-300 rounded p-2 @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
            @error('title')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content Field -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea id="content" name="content" rows="5" class="w-full border-gray-300 rounded p-2 @error('content') border-red-500 @enderror" required>{{ old('content') }}</textarea>
            @error('content')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Recipient Type Field -->
        <div class="mb-4">
            <label for="recipient_type" class="block text-gray-700">Recipient Type</label>
            <select id="recipient_type" name="recipient_type" class="w-full border-gray-300 rounded p-2" required>
                <option value="all_users" @if(old('recipient_type') == 'all_users') selected @endif>All Users</option>
                <option value="batch" @if(old('recipient_type') == 'batch') selected @endif>Batch</option>
                <option value="single_user" @if(old('recipient_type') == 'single_user') selected @endif>Single User</option>
                <option value="some_users" @if(old('recipient_type') == 'some_users') selected @endif>Some Users</option>
            </select>
        </div>

        <!-- Batch Selection (Visible if 'batch' is selected as recipient_type) -->
        <div id="batch-field" class="mb-4 @if(old('recipient_type') !== 'batch') hidden @endif">
            <label for="batch_id" class="block text-gray-700">Select Batch</label>
            <select id="batch_id" name="batch_id" class="w-full border-gray-300 rounded p-2 @error('batch_id') border-red-500 @enderror">
                <option value="">Select a Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" @if(old('batch_id') == $batch->id) selected @endif>
                        {{ $batch->batch_name }} (Course: {{ $batch->course->title }})
                    </option>
                @endforeach
            </select>
            @error('batch_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Some Users Selection (Visible if 'some_users' is selected as recipient_type) -->
        <div id="some-users-field" class="mb-4 @if(old('recipient_type') !== 'some_users') hidden @endif">
            <label for="some_user_ids" class="block text-gray-700">Select Users</label>
            <select id="some_user_ids" name="some_user_ids[]" multiple class="w-full border-gray-300 rounded p-2 @error('some_user_ids') border-red-500 @enderror">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if(in_array($user->id, old('some_user_ids', []))) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('some_user_ids')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Single User Selection (Visible if 'single_user' is selected as recipient_type) -->
        <div id="single-user-field" class="mb-4 @if(old('recipient_type') !== 'single_user') hidden @endif">
            <label for="user_id" class="block text-gray-700">Select User</label>
            <select id="user_id" name="user_id" class="w-full border-gray-300 rounded p-2 @error('user_id') border-red-500 @enderror">
                <option value="">Select a User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send Message</button>
        </div>
    </form>
</div>

<script>
    // JavaScript to toggle visibility based on recipient type
    document.getElementById('recipient_type').addEventListener('change', function() {
        const recipientType = this.value;
        document.getElementById('batch-field').classList.toggle('hidden', recipientType !== 'batch');
        document.getElementById('some-users-field').classList.toggle('hidden', recipientType !== 'some_users');
        document.getElementById('single-user-field').classList.toggle('hidden', recipientType !== 'single_user');
    });
</script>
@endsection


