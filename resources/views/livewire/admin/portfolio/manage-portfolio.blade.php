<div>
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Portfolio List</h2>
        <a href="{{route('admin.portfolio.create')}}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Add New Portfolio
        </a>
    </div>

    <div class="max-w-5xl mx-auto mt-8">
        @if($portfolios->isEmpty())
            <p class="text-gray-800">No portfolios found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Link</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($portfolios as $portfolio)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $portfolio->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-20 h-20 object-cover rounded-md">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ $portfolio->url }}" target="_blank" class="text-indigo-600 hover:underline">View Portfolio</a>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $portfolio->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                                        
                                        <button 
                                            wire:click="delete({{ $portfolio->id }})" 
                                            wire:confirm="Are you sure you want to delete this portfolio?"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

