@extends('studentdashboard.include.base')
@section('content')

<div class="mt-16 p-6 bg-gray-50 dark:bg-gray-900">
  <!-- Page Heading -->
  <div class="border-b border-gray-300 dark:border-gray-700 pb-4 mb-6">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Courses</h1>
    </div>
  </div>

  <!-- Search and Filters -->
  <form action="#" class="container mx-auto mb-6 border-b border-gray-300 dark:border-gray-700 pb-4">
    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
      <!-- Search Bar -->
      <div class="relative flex-1">
        <input type="text" placeholder="Search courses" id="searchSample02"
          class="w-full px-4 py-2 text-gray-800 dark:text-gray-200 border rounded-lg dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-400">
        <button class="absolute right-2 top-2 text-gray-500 dark:text-gray-300">
          <i class="material-icons">search</i>
        </button>
      </div>

      <!-- Category Filter -->
      <div class="flex flex-col space-y-2">
        <label for="custom-select" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Category</label>
        <select id="custom-select"
          class="w-full md:w-56 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-400">
          <option selected>All categories</option>
          <option value="1">Vue.js</option>
          <option value="2">Node.js</option>
          <option value="3">GitHub</option>
        </select>
      </div>

      <!-- Status Filter -->
      <div class="flex flex-col space-y-2">
        <label for="published01" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Status</label>
        <select id="published01"
          class="w-full md:w-56 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-2 focus:ring-blue-400">
          <option selected>All</option>
          <option value="1">In Progress</option>
          <option value="3">New Releases</option>
        </select>
      </div>
    </div>
  </form>

  <!-- Courses Grid -->
  <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($courses as $course)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
      <!-- Course Image -->
      <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="Course Image"
        class="w-full h-40 object-cover">
      <!-- Course Content -->
      <div class="p-4 space-y-3">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 truncate">
          <a href="#">{{ $course->title }}</a>
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Instructor: <span
            class="text-blue-500">{{ $course->instructor }}</span></p>
        <div class="flex justify-between items-center">
          <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">₹ {{ $course->discounted_fees }}</span>
          <a href="{{ route('student.buyCourse', ['id' => $course->id]) }}"
            class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">
            <i class="material-icons">add_shopping_cart</i>
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Pagination -->
  <div class="container mx-auto mt-6 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
    <div class="text-sm text-gray-600 dark:text-gray-400">
      Showing {{ $courses->firstItem() }} - {{ $courses->lastItem() }} of {{ $courses->total() }} courses
    </div>
    <div>
      {{ $courses->links('pagination::bootstrap-4') }}
    </div>
  </div>
</div>

@endsection
