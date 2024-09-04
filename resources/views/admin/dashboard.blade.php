@extends('admin.base')

@section('title', 'Dashboard | ')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
    <!-- Admissions Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-orange-600 text-orange shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $admissionsCount }}</p>
        <h3 class="text-2xl text-orange-600 font-semibold mb-3">Admissions</h3>
        <a href="#" class="mt-4 inline-block text-blue-600 hover:text-white">View Details</a>
    </div>

    <!-- Students Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-green-600 text-green-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $studentsCount }}</p>
        <h3 class="text-2xl text-green-600 font-semibold mb-3">Students</h3>
        <a href="#" class="mt-4 inline-block text-green-600 hover:text-white">View Details</a>
    </div>

    <!-- Categories Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-pink-600 text-pink-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $categoriesCount }}</p>
        <h3 class="text-2xl text-pink-600 font-semibold mb-3">Categories</h3>
        <a href="#" class="mt-4 inline-block text-pink-600 hover:text-white">View Details</a>
    </div>

    <!-- Courses Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-yellow-600 text-yellow-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $coursesCount }}</p>
        <h3 class="text-2xl text-yellow-600 font-semibold mb-3">Courses</h3>
        <a href="#" class="mt-4 inline-block text-yellow-600 hover:text-white">View Details</a>
    </div>

    <!-- Batches Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-blue-600 text-blue-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $batchesCount }}</p>
        <h3 class="text-2xl text-blue-600 font-semibold mb-3">Batches</h3>
        <a href="#" class="mt-4 inline-block text-blue-600 hover:text-white">View Details</a>
    </div>

    <!-- Lessons Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-purple-600 text-purple-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $lessonsCount }}</p>
        <h3 class="text-2xl text-purple-600 font-semibold mb-3">Lessons</h3>
        <a href="#" class="mt-4 inline-block text-purple-600 hover:text-white">View Details</a>
    </div>

    <!-- Chapters Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-teal-600 text-teal-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $chaptersCount }}</p>
        <h3 class="text-2xl text-teal-600 font-semibold mb-3">Chapters</h3>
        <a href="#" class="mt-4 inline-block text-teal-600 hover:text-white">View Details</a>
    </div>

    <!-- Payments Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-red-600 text-red-600 shadow-xl rounded-lg p-6">
        <p class="text-4xl font-bold">{{ $paymentsCount }}</p>
        <h3 class="text-2xl text-red-600 font-semibold mb-3">Payments</h3>
        <a href="#" class="mt-4 inline-block text-red-600 hover:text-white">View Details</a>
    </div>

    <!-- Due Payments Card -->
   
</div>

@endsection
