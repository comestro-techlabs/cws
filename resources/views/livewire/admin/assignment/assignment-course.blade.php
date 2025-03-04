<div class="container mx-auto px-4 py-8">
    <h1 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-6">Courses Overview</h1>
    
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($courses as $course)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">{{ $course->title }}</h2>
                <p class="text-gray-600">Assignments: {{ $course->assignments->count() }}</p>
                <p class="text-gray-600">Total Students: {{ $course->total_users }}</p>
                <p class="text-gray-600">Submitted: {{ $course->unique_user_count }}</p>
                <a href="{{ route('assignment.review', $course->slug) }}" 
                   class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Review
                </a>
            </div>
        @endforeach
    </div>
</div>