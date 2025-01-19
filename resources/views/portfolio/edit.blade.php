@extends('admin.base')

@section('title', 'Edit Portfolio')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit Portfolio</h1>
        <a href="{{ route('portfolio.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Back To Portfolio
        </a>
    </div>
    
  

    <form action="{{ route('portfolio.admin.update', $portfolios->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ $portfolios->title }}" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter portfolio title"
            >
            @error('title')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

         
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
            <input 
                type="file" 
                name="image" 
                id="image" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                accept="image/*"
                onchange="previewImage(event)"
            >
            @error('image')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
            @if ($portfolios->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img src="{{ asset('storage/' . $portfolios->image) }}" alt="Portfolio Image" class="w-24 h-24 mt-2 rounded-md shadow-md">
                </div>
            @endif
        
           
            <div id="imagePreview" class="mt-4 hidden">
                <p class="text-sm text-gray-500">Preview New Image:</p>
                <img src="" alt="New Portfolio Image" class="w-24 h-24 mt-2 rounded-md shadow-md">
            </div>
        </div>
        
         
        

        <div>
            <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL</label>
            <input 
                type="url" 
                name="url" 
                id="url" 
                value="{{ $portfolios->url }}" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="https://example.com"
             
            >
            @error('url')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea 
                name="description" 
                id="description" 
                rows="4" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter a brief description of the portfolio"
            >{{ $portfolios->description }}</textarea>
            @error('description')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Update
            </button>
        </div>
    </form>
</div>
<script>
    function previewImage(event) {
        const fileInput = event.target;
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = previewContainer.querySelector('img');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result; 
                previewContainer.classList.remove('hidden'); 
            };
            reader.readAsDataURL(fileInput.files[0]); 
        } else {
            previewImage.src = '';
            previewContainer.classList.add('hidden'); 
        }
    }
</script>

@endsection
