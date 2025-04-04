@extends('admin.base')

@section('title', 'Edit Workshop')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    @if (session('error'))
    <div class="bg-red-500 text-white p-2 rounded">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p class="font-bold">Success</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Workshop</h1>

    <form action="{{ route('admin.workshops.update', $workshops->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Workshop Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ $workshops->title}}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter workshop title"
            >
            @error('title')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Workshop Date</label>
            <input
                type="date"
                name="date"
                id="date"
                value="{{ $workshops->date }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
            @error('date')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="time" class="block text-sm font-medium text-gray-700">Workshop Time</label>
            <input
                type="time"
                name="time"
                id="time"
                value="{{ $workshops->time }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
            @error('time')
            <p class="text-xs text-red-500">{{ $message }}</p>
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

            @if ($workshops->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img src="{{ asset('storage/' . $workshops->image) }}" alt=" Image" class="w-24 h-24 mt-2 rounded-md shadow-md">
                </div>
            @endif


            <div id="imagePreview" class="mt-4 hidden">
                <p class="text-sm text-gray-500">Preview New Image:</p>
                <img src="" alt="New  Image" class="w-24 h-24 mt-2 rounded-md shadow-md">
            </div>
        </div>




        <div>
            <label for="fees" class="block text-sm font-medium text-gray-700">Workshop Fees</label>
            <input
                type="number"
                name="fees"
                id="fees"
                value="{{ $workshops->fees }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="Enter workshop fees"
            >
            @error('fees')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="active" class="block text-sm font-medium text-gray-700">Is Active?</label>
            <select
                name="active"
                id="active"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option value="1" {{ ( $workshops->active) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ ( $workshops->active) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button
            type="submit"
            class="w-full bg-blue-400 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Update Workshop
        </button>
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
