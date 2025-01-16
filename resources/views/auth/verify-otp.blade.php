@extends('public.layout')

@section('title')
Login
@endsection

@section('content')
    <div class="max-w-lg mx-auto mt-8">
        <form method="POST" action="{{ route('auth.verifyOtp') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ $email }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required readonly>
            </div>

            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">OTP</label>
                <input type="text" id="otp" name="otp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('otp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Verify OTP
                </button>
            </div>

            @if(session('success'))
                <div class="text-green-500 text-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="text-red-500 text-sm mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection