
<div class="container mx-auto px-4 sm:px-8 py-8">
    <div class="flex flex-col gap-8">
        <div class="w-full mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">               
                
                    <div class="flex flex-wrap justify-between items-center p-4">
                        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-600 pl-3 mb-5">
                            Messages
                        </h2>
                        <a href="{{route('admin.message.create')}} " wire:navigate 
                           class="px-4 py-2 bg-purple-800 text-white rounded hover:bg-purple-900">
                            Add New Messages
                        </a>
                    </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Recipient Type</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created At</th>
                                
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($messages as $message)
                                <tr class="hover:bg-gray-50 text-center">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $message->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($message->recipient_type) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $message->created_at->format('d M, Y') }}</td>
                                   
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex gap-2 item-center justify-center">
                                            <button 
                                                wire:click="$set('selectedMessage', {{ $message->id }})"
                                                class="bg-blue-500 text-white py-1 px-4 rounded-lg"
                                            >
                                                View
                                            </button> 
                                            <span>|</span>
                                            <button 
                                                wire:click="deleteMessage({{ $message->id }})"
                                                wire:confirm="Are you sure you want to delete this message?"
                                                class="bg-red-500 text-white py-1 px-4 rounded-lg"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                           
                               {{-- view message --}}
                               @if ($selectedMessage === $message->id)
                               <tr wire:key="details-{{ $message->id }}">
                                   <td colspan="4" class="px-6 py-4 bg-gray-50">
                                       <div class="p-4">
                                           <p class="mb-4"><strong>Title:</strong> {{ $message->title }}</p>
                                           <p class="mb-4"><strong>Content:</strong> {{ $message->content }}</p>
                                           <p class="mb-4"><strong>Recipient Type:</strong> {{ ucfirst($message->recipient_type) }}</p>
                                           <div class="mb-4">
                                               <strong>Recipients:</strong>
                                               @if (count($message->recipients ?? []) > 0)
                                                   @php
                                                       $recipients = \App\Models\User::whereIn('id', $message->recipients)->get();
                                                   @endphp
                                                   <div class="border border-gray-300 rounded max-h-64 overflow-y-auto mt-4">
                                                       <table class="min-w-full text-left text-sm text-gray-500">
                                                           <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                                                               <tr>
                                                                   <th class="px-4 py-2">Name</th>
                                                                   <th class="px-4 py-2">Email</th>
                                                               </tr>
                                                           </thead>
                                                           <tbody class="divide-y divide-gray-200">
                                                               @foreach ($recipients as $recipient)
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
                                           <button 
                                               wire:click="$set('selectedMessage', null)"
                                               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                                           >
                                               Close
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                           @endif
                       @empty
                           <tr>
                               <td colspan="4" class="px-6 py-3 text-center">
                                   No messages found
                               </td>
                           </tr>
                       @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>

</div>