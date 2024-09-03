@extends('public.layout')

@section('content')
<div class="flex justify-center items-center h-screen bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">
    <div class="w-full max-w-md bg-white p-10 rounded-lg shadow-2xl">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Student Login</h2>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5 space-y-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('auth.login.post') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="email" class="block text-lg font-semibold text-gray-700">Email:</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
                @error('email')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-8">
                <label for="password" class="block text-lg font-semibold text-gray-700">Password:</label>
                <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" required>
                @error('password')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
            </div>
            <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300 ease-in-out transform hover:scale-105 mb-4">Login</button>
        </form>
        <a href="{{ route('auth.register') }}" class="block text-center text-purple-600 font-semibold mt-4 hover:underline">Apply to Join Us</a>
    </div>
</div>
@endsection
