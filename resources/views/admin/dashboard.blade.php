@extends('admin.base')

@section('title', 'Dashboard | ')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
    <!-- Admissions Card -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Admissions</h3>
        <p class="text-4xl font-bold">{{ $admissionsCount }}</p>
        <a href="#" class="mt-4 inline-block text-indigo-200 hover:text-white">View Details</a>
    </div>

    <!-- Students Card -->
    <div class="bg-gradient-to-r from-green-400 to-blue-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Students</h3>
        <p class="text-4xl font-bold">{{ $studentsCount }}</p>
        <a href="#" class="mt-4 inline-block text-green-200 hover:text-white">View Details</a>
    </div>

    <!-- Categories Card -->
    <div class="bg-gradient-to-r from-pink-500 to-red-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Categories</h3>
        <p class="text-4xl font-bold">{{ $categoriesCount }}</p>
        <a href="#" class="mt-4 inline-block text-pink-200 hover:text-white">View Details</a>
    </div>

    <!-- Courses Card -->
    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Courses</h3>
        <p class="text-4xl font-bold">{{ $coursesCount }}</p>
        <a href="#" class="mt-4 inline-block text-yellow-200 hover:text-white">View Details</a>
    </div>

    <!-- Batches Card -->
    <div class="bg-gradient-to-r from-blue-400 to-teal-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Batches</h3>
        <p class="text-4xl font-bold">{{ $batchesCount }}</p>
        <a href="#" class="mt-4 inline-block text-blue-200 hover:text-white">View Details</a>
    </div>

    <!-- Lessons Card -->
    <div class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Lessons</h3>
        <p class="text-4xl font-bold">{{ $lessonsCount }}</p>
        <a href="#" class="mt-4 inline-block text-purple-200 hover:text-white">View Details</a>
    </div>

    <!-- Chapters Card -->
    <div class="bg-gradient-to-r from-teal-400 to-cyan-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Chapters</h3>
        <p class="text-4xl font-bold">{{ $chaptersCount }}</p>
        <a href="#" class="mt-4 inline-block text-teal-200 hover:text-white">View Details</a>
    </div>

    <!-- Payments Card -->
    <div class="bg-gradient-to-r from-red-400 to-pink-500 text-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold mb-3">Payments</h3>
        <p class="text-4xl font-bold">{{ $paymentsCount }}</p>
        <a href="#" class="mt-4 inline-block text-red-200 hover:text-white">View Details</a>
    </div>

    <!-- Due Payments Card -->
   
</div>
@endsection
