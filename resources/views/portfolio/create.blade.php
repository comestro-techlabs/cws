@extends('admin.base')

@section('title', 'Portfolio')

@section('content') 

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p class="font-bold">Success</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Create Portfolio</h1>

    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter portfolio title"
                value="{{old('title')}}"
            >
            @error('title')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                onchange="previewImage()"
            >
            @error('image')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
            <div id="imagePreviewContainer" class="mt-4">
                <img 
                    id="imagePreview" 
                    src="" 
                    alt="Image Preview" 
                    class="hidden max-w-[150px] h-auto rounded-md shadow-md" 
                />
            </div>
        </div>

        <div>
            <label for="url" class="block text-sm font-medium text-gray-700">Portfolio URL</label>
            <input
                type="url"
                name="url"
                id="url"
                value="{{old('url')}}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="https://example.com"
            >
            @error('url')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter portfolio description"
            >{{old('description')}}</textarea>
            @error('description')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-blue-400 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Submit
        </button>
    </form>
</div>

<script>
    function previewImage() {
        const fileInput = document.getElementById('image');
        const file = fileInput.files[0];
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            previewImage.classList.add('hidden');
        }
    }
</script>

@endsection
