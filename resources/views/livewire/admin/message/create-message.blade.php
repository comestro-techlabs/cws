<div>
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto p-6">
        <div class="flex flex-wrap justify-between items-center p-4">
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">
                Create New Message
            </h2>
        </div>

        <form wire:submit.prevent="save" class="mt-6">
           
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    wire:model="title"
                    class="w-full border-gray-300 rounded p-2 @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

           
            <div class="mb-4">
                <label for="content" class="block text-gray-700">Content</label>
                <textarea 
                    id="content" 
                    wire:model="content"
                    rows="5" 
                    class="w-full border-gray-300 rounded p-2 @error('content') border-red-500 @enderror"
                    required
                ></textarea>
                @error('content')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

           
            <div class="mb-4">
                <label for="recipient_type" class="block text-gray-700">Recipient Type</label>
                <select 
                    id="recipient_type" 
                    wire:model="recipient_type"
                    class="w-full border-gray-300 rounded p-2"
                    required
                >
                    <option value="all_users">All Users</option>
                    <option value="batch">Batch</option>
                    <option value="single_user">Single User</option>
                    <option value="some_users">Some Users</option>
                </select>
            </div>

         
            <div class="mb-4" x-show="$wire.recipient_type === 'batch'">
                <label for="batch_id" class="block text-gray-700">Select Batch</label>
                <select 
                    id="batch_id" 
                    wire:model="batch_id"
                    class="w-full border-gray-300 rounded p-2 @error('batch_id') border-red-500 @enderror"
                >
                    <option value="">Select a Batch</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">
                            {{ $batch->batch_name }} (Course: {{ $batch->course->title }})
                        </option>
                    @endforeach
                </select>
                @error('batch_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

           
            <div class="mb-4" x-show="$wire.recipient_type === 'some_users'">
                <label for="some_user_ids" class="block text-gray-700">Select Users</label>
                <select 
                    id="some_user_ids" 
                    wire:model="some_user_ids"
                    multiple 
                    class="w-full border-gray-300 rounded p-2 @error('some_user_ids') border-red-500 @enderror"
                >
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('some_user_ids')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="mb-4" x-show="$wire.recipient_type === 'single_user'">
                <label for="user_id" class="block text-gray-700">Select User</label>
                <select 
                    id="user_id" 
                    wire:model="user_id"
                    class="w-full border-gray-300 rounded p-2 @error('user_id') border-red-500 @enderror"
                >
                    <option value="">Select a User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Send Message
                </button>
            </div>
        </form>
    </div>
</div>

