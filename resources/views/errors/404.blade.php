@extends('public.layout')
@section('content')

    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-blue-700 ">404</h1>
            <p class="mt-4 text-2xl font-medium text-gray-900 ">Oops! Page not found.</p>
            <p class="mt-2 text-gray-600 ">The page you're looking for doesn't exist or has been moved.</p>
            <a href="{{url('/')}}" class="mt-6 inline-block px-6 py-3 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300   ">Go Back Home</a>
        </div>
    </div>
@endsection
