@extends('admin.base')

@section('title', 'Create Workshop')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">



    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p class="font-bold">Success</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Create Workshop</h1>

    <livewire:admin.workshops.create-workshop/>
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
