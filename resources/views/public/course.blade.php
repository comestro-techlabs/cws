@extends('public.layout')

@section('content')
<div class="container mx-auto p-6">
    <!-- Course Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $course->title }}</h1>
        <p class="text-gray-600 text-lg mb-4">{{ $course->description }}</p>
        <div class="flex items-center">
            <span class="text-xl font-semibold text-teal-600">Fees: ${{ $course->fees }}</span>
            <span class="ml-4 text-xl font-semibold text-gray-600">Duration: {{ $course->duration }} months</span>
        </div>
    </div>

    <!-- Course Features -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Features</h2>
        <ul class="list-disc list-inside text-gray-700">
            @foreach($course->features as $feature)
                <li>{{ $feature->name }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Course Batches -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Available Batches</h2>
        @if($course->batches->isNotEmpty())
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">Batch Name</th>
                        <th class="py-2 px-4 text-left">Start Date</th>
                        <th class="py-2 px-4 text-left">End Date</th>
                        <th class="py-2 px-4 text-left">Timings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course->batches as $batch)
                        <tr>
                            <td class="py-2 px-4">{{ $batch->name }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}</td>
                            <td class="py-2 px-4">{{ $batch->timings }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No batches available at the moment.</p>
        @endif
    </div>

    <!-- Course Chapters and Lessons -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Chapters and Lessons</h2>
        @if($course->chapters->isNotEmpty())
            <div class="accordion" id="chaptersAccordion">
                @foreach($course->chapters as $chapter)
                    <div class="accordion-item mb-4">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed text-lg font-semibold text-gray-700" type="button" data-toggle="collapse" data-target="#chapter-{{ $chapter->id }}" aria-expanded="true" aria-controls="chapter-{{ $chapter->id }}">
                                {{ $chapter->title }}
                            </button>
                        </h3>
                        <div id="chapter-{{ $chapter->id }}" class="accordion-collapse collapse" data-parent="#chaptersAccordion">
                            <div class="accordion-body">
                                <p class="text-gray-600">{{ $chapter->description }}</p>
                                <ul class="list-decimal list-inside mt-3 text-gray-700">
                                    @foreach($chapter->lessons as $lesson)
                                        <li>{{ $lesson->title }} - {{ $lesson->duration }} mins</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No chapters available at the moment.</p>
        @endif
    </div>
</div>
@endsection
