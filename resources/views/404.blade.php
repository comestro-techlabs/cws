@extends('home.homeBase')
@section('content')

    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-blue-700 dark:text-blue-400">404</h1>
            <p class="mt-4 text-2xl font-medium text-gray-900 dark:text-white">Oops! Page not found.</p>
            <p class="mt-2 text-gray-600 dark:text-gray-300">The page you're looking for doesn't exist or has been moved.</p>
            <a href="{{url('/')}}" class="mt-6 inline-block px-6 py-3 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go Back Home</a>
        </div>
    </div>
@endsection
