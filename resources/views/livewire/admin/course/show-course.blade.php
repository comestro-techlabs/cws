<div>
    <div class="p-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Course Details</h1>
            {{-- <a href="{{ route('admin.course.index') }}" class="text-blue-500 hover:underline">Back to Courses</a> --}}
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold ">Title</p>
                    <p class="text-gray-600">{{ $course->title }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold">Instructor</p>
                    <p class="text-gray-600">{{ $course->instructor }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold">Duration</p>
                    <p class="text-gray-600">{{ $course->duration }} Weeks</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold">Description</p>
                    <p class="text-gray-600">{{ $course->description }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold">Discounted Price</p>
                    <p class="text-gray-600">{{ $course->discounted_fees }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold">Actual Price</p>
                    <p class="text-gray-600">{{ $course->fees }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-lg font-semibold">Status</p>
                    <p class="text-gray-600">{{ $course->status }}</p>
                </div>

            </div>
        </div>
    </div>
</div>
