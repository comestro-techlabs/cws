<div>
    <div class="container mt-24 px-4">
        <h2 class="text-2xl font-semibold mb-6">All Attempts for Course: {{ $course->title }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($attempts_data as $data)
                <div class="card bg-white rounded-lg shadow-md p-4">
                    <div class="card-body">
                        <h5 class="text-lg font-semibold mb-2">Attempt: {{ $data['attempt'] }}</h5>
                        <h5 class="text-lg font-semibold mb-2">Total Question: {{ $data['questions'] }}</h5>
                       
                        <p class="text-md mb-2">
                            <strong>Total Marks Scored:</strong> {{ $data['total_marks'] }}
                        </p>
                        <p class="text-sm text-gray-600 mb-2">
                            <strong>Attempt Status:</strong>
                            @if($data['attempt'] == 1)
                                <span class="text-blue-500">First Attempt</span>
                            @else
                                <span class="text-green-500">Second Attempt</span>
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No attempts found for this course.</p>
            @endforelse
        </div>
    </div>
</div>