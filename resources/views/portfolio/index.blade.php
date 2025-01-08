@extends('admin.base')

@section('title', 'Portfolio ')

@section('content') 

<div class="max-w-5xl mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Portfolio List</h1>
        <a href="{{ route('portfolio.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Add New Portfolio
        </a>
    </div>
    
    {{-- <h1 class="text-2xl font-bold mb-6">Portfolio List</h1> --}}

    @if($portfolios->isEmpty())
        <p>No portfolios found.</p>
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
                                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                  
                                    <a href="{{route('portfolio.admin.edit', $portfolio->id)}}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
    
                                   
                                    <form action="{{route('portfolio.admin.destroy',$portfolio->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this portfolio?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                                    </form>
                                </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
