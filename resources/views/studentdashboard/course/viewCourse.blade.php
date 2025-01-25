@extends('studentdashboard.include.base')
@section('content')

<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Course Details -->
        <div class="col-span-2">
            <!-- Course Title -->
            <div class="border-b pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{$course->title}}</h1>
            </div>

            <!-- Course Image -->
            <div class="relative mb-6">
                <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="Course Image" class="w-full rounded-lg shadow-md">
                <div class="absolute inset-0 bg-black bg-opacity-25 flex justify-center items-center opacity-0 hover:opacity-100 transition">
                    <button class="bg-white text-black px-4 py-2 rounded-md shadow">Preview</button>
                </div>
            </div>

            <!-- Course Description -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
                <p class="text-gray-600 bg-gray-50 border border-gray-200 rounded-md p-4">{{$course->description}}</p>
            </div>

            <!-- Course Chapters -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Chapters</h2>
                <ul class="space-y-2">
                    @foreach ($course->chapters as $item)
                        <li class="bg-gray-50 border border-gray-200 rounded-md p-3">
                            <a href="#" class="text-blue-600 hover:underline">{{$item->id}}. {{$item->title}}</a>
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
                    <span class="text-gray-700 font-medium">{{$course->duration}} Month Access</span>
                    <span class="text-xl font-bold text-green-600">₹{{$course->discounted_fees}}</span>
                </div>
                <form action="{{route('phonepe.initiate')}}" method="post" class="mb-4">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="amount" value="{{$course->discounted_fees}}">
                    <button type="submit" class="flex items-center justify-center w-full bg-purple-600 text-white rounded-lg py-3 shadow hover:bg-purple-700 transition">
                        <img src="https://img.icons8.com/?size=100&id=OYtBxIlJwMGA&format=png&color=ffffff" alt="PhonePe Logo" class="w-6 h-6 mr-2">
                        <span>Pay with PhonePe</span>
                    </button>
                </form>

                <a href="{{route('phonepe.payment')}}" id="pay-button" class="flex items-center justify-center w-full bg-blue-600 text-white rounded-lg py-3 shadow hover:bg-blue-700 transition">
                    <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png" alt="Razorpay Logo" class="w-8 h-8 mr-2">
                    <span>Pay with Razorpay</span>
                </a>
            </div>

            <!-- Course Features -->
            <div class="bg-gray-800 text-white rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Features</h3>
                <ul class="space-y-2">
                    @foreach ($course->features as $feature)
                        <li class="flex items-center">
                            <i class="material-icons text-green-400 mr-2">check_circle</i>
                            <span>{{$feature->name}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Integration -->
<form action="{{ route('save.course.payment') }}" method="post">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" value="{{ $course->id }}" name="course_id">
    <input type="hidden" value="{{ $course->discounted_fees }}" name="amount">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @auth
    <script>
        document.getElementById('pay-button').onclick = function(e) {
            e.preventDefault();
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": "{{ $course->discounted_fees }}" * 100,
                "currency": "INR",
                "name": "LearnSyntax",
                "description": "Processing Fee",
                "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                "handler": function(response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.forms[0].submit();
                },
                "prefill": {
                    "name": "{{ Auth::user()->name }}",
                    "email": "{{ Auth::user()->email }}"
                },
                "theme": {
                    "color": "#0a64a3"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
    @endauth
</form>

@endsection
