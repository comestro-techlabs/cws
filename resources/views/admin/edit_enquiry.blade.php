@extends('admin.base')

@section('title', 'Update Enquiry | ')

@section('content')
    <div class="flex flex-col items-center">
        <form action="{{ route('admin.enquiry.update', $enquiry->id) }}"
            class="w-full max-w-lg border border-orange-500 rounded-lg shadow-lg px-8 py-6 " method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold text-orange-600 text-center mb-6">Update Enquiry Details</h2>

            <div class ="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" value="{{ $enquiry->name }}"
                    class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    readonly />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact -->
            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                <input type="text" name="mobile" id="contact" value="{{ $enquiry->mobile }}"
                    class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    readonly />
                @error('mobile')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $enquiry->email }}"
                    class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    readonly />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Education Qualification -->
            <div class="mb-4">
                <label for="education_qualification" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="education_qualification"
                    class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none h-24"
                    readonly>{{ $enquiry->message }}</textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-4">

                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="0" {{ $enquiry->status == '0' ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ $enquiry->status == '1' ? 'selected' : '' }}>Approved</option>
                    <option value="2" {{ $enquiry->status == '2' ? 'selected' : '' }}>Close</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Enquiry
                </button>
            </div>
        </form>

    </div>
@endsection
