@extends('public.layout')

@section('title')
    registration seccessfull
@endsection

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full flex flex-col">
        <h2 class="text-3xl font-bold text-center text-teal-600 mb-6">Registration Successful!</h2>
        <p class="text-lg text-gray-700 text-center mb-4">
            Thank you for registering. We will review your application and approve it soon.
        </p>
        <p class="text-gray-600 text-center mb-8">
            Once approved, you will be able to add courses to your profile.
        </p>
        <a href="{{ route('public.index') }}" class="w-full py-2 px-4 bg-teal-600 text-white font-bold rounded-md text-center hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50">
            Go to Homepage
        </a>
    </div>
</div>
@endsection
