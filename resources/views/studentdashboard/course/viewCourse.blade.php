@extends('studentdashboard.include.base')

@section('content')

<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Course Details -->
        <div class="col-span-2">
            <!-- Course Title -->
            <div class="border-b pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
            </div>

            <!-- Course Image -->
            <div class="relative mb-6">
                <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                     alt="Course Image"
                     class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            <!-- Course Description -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
                <p class="text-gray-600 bg-gray-50 border border-gray-200 rounded-md p-4">{{ $course->description }}</p>
            </div>

            <!-- Course Chapters -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Chapters</h2>
                <ul class="space-y-2">
                    @foreach ($course->chapters as $item)
                        <li class="bg-gray-50 border border-gray-200 rounded-md p-3">
                            <a href="#" class="text-blue-600 hover:underline">{{ $item->id }}. {{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Right Column: Payment and Features -->
        <div>
            <!-- Payment Section -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-700 font-medium">Duration: {{ $course->duration }} Weeks</span>
                    <span class="text-xl font-bold text-green-600">₹{{ $course->discounted_fees }}</span>
                </div>
                {{-- <form action="{{ route('phonepe.initiate') }}" method="post" class="mb-4">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="amount" value="{{ $course->discounted_fees }}">
                    <button type="submit"
                            class="flex items-center justify-center w-full bg-purple-600 text-white rounded-lg py-3 shadow hover:bg-purple-700 transition">
                        <img src="https://img.icons8.com/?size=100&id=OYtBxIlJwMGA&format=png&color=ffffff"
                             alt="PhonePe Logo"
                             class="w-6 h-6 mr-2">
                        <span>Pay with PhonePe</span>
                    </button>
                </form> --}}

                {{-- <a href="{{ route('phonepe.payment') }}" id="pay-button"
                   class="flex items-center justify-center w-full bg-blue-600 text-white rounded-lg py-3 shadow hover:bg-blue-700 transition">
                    <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png"
                         alt="Razorpay Logo"
                         class="w-8 h-8 mr-2">
                    <span>Pay with Razorpay</span>
                </a> --}}
            </div>

            <!-- Course Features -->
            <div class=" bg-slate-100 text-slate-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Features</h3>
                <ul class="space-y-2">
                    @foreach ($course->features as $feature)
                        <li class="flex items-center">
                            <i class="material-icons text-green-400 mr-2">check_circle</i>
                            <span>{{ $feature->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
{{-- #todo: shaique --}}

@endsection
