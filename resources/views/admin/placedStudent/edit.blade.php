@extends('admin.base')

@section('title', 'Edit StudentPlaced')

@section('content')
<div class="mx-auto mt-10 bg-white  shadow-md rounded-lg p-6">
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edit StudentPlaced</h1>
        <a href="{{ route('placedStudent.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Back To Placed Students
        </a>
    </div>

    <form action="{{ route('placedStudent.update', $placedStudent->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $placedStudent->name) }}"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter name"
                required
            >
            @error('name')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea
                name="content"
                id="content"
                rows="4"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter a brief description"
                required
            >{{ old('content', $placedStudent->content) }}</textarea>
            @error('content')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
            <input
                type="text"
                name="position"
                id="position"
                value="{{ old('position', $placedStudent->position) }}"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter position"
                required
            >
            @error('position')
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
            
            @if ($placedStudent->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img src="{{ asset('storage/' . $placedStudent->image) }}" alt="Current Image" class="w-24 h-24 mt-2 rounded-md shadow-md">
                </div>
            @endif

            <div id="imagePreview" class="mt-4 hidden">
                <p class="text-sm text-gray-500">Preview New Image:</p>
                <img src="" alt="New Student image" class="w-24 h-24 mt-2 rounded-md shadow-md">
            </div>
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
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector('#imagePreview img').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
