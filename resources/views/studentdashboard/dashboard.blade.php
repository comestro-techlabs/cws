@extends('studentdashboard.include.base')
@section('content')
<!-- Header Layout Content -->
<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page"
    style="">
   
    @if ($courses->isEmpty())
    <div class="flex flex-col items-center justify-center md:mt-16 lg:mt-20 text-center px-6 md:px-4 space-y-2">
        <img src="{{ asset('assets/welcome.png') }}" class="w-56 md:w-64 lg:w-72 ">
        <h4 class="text-md md:text-2xl font-semibold text-gray-800 mb-2">
            Welcome! Please purchase a course to access your dashboard.
        </h4>
        <a href="{{ route('student.course') }}">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 text-sm md:text-md">
                Browse Courses
            </button>

        </a>
        <button id="membership-pay-button"
            class="flex items-center justify-center w-48 h-12 bg-indigo-400 border-4 border-double text-black mt-2 shadow-xl px-6 py-3 transition duration-300 ease-in-out transform hover:scale-105 space-x-3 rounded-lg">
            <span>Become Member</span>
        </button>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
        <!-- Courses Section -->
        <div class="px-6 py-3 rounded-lg border border-slate-200 lg:col-span-2">
            <h2 class="text-md font-medium mb-4 text-gray-600">My Courses</h2>
            <ul class="space-y-4">
                @foreach ($payments as $payment)
                <li class="bg-slate-50 p-4 rounded-lg flex justify-between items-center gap-4">
                    <!-- Course Image -->
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/course_images/' . $payment->course->course_image) }}"
                            alt="Course Image" class="w-16 h-16 rounded-full object-cover shadow-sm">

                        <!-- Course Details -->
                        <div>
                            <span
                                class="text-slate-700 font-semibold text-lg">{{ $payment->course->title }}</span>
                            <p class="text-sm text-gray-500">Duration: {{ $payment->course->duration }} hours
                            </p>
                            <p class="text-sm text-gray-500">Batch: </p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex flex-col items-end">
                        <div class="w-40 bg-gray-200 rounded-full overflow-hidden h-4">
                            <div class="bg-blue-500 h-4" style="width: {{ $payment->progress }}%;"></div>
                        </div>
                        <span class="text-sm text-gray-500 mt-2">
                            Progress: <span class="text-green-500 font-medium">{{ $payment->progress }}%</span>
                        </span>
                    </div>
                </li>
                @endforeach


            </ul>
        </div>


        <!-- Assignments Section -->
        <div class="border border-slate-200 px-6 py-3 rounded-lg lg:col-span-1">
            <h2 class="text-md font-medium mb-4 text-gray-600">Assignments</h2>
            <ul class="space-y-4">
                @if ($assignments->isNotEmpty())
                @foreach ($assignments as $assignment)
                <li class="p-4 rounded-lg flex justify-between items-center shadow-sm">
                    <!-- Assignment Title -->
                    <span class="text-gray-800 font-semibold">📜 {{ $assignment->title }}</span>

                    <!-- Upload Status -->
                    <span class="flex flex-col items-end">
                        @if ($assignment->uploads->isNotEmpty())
                        @foreach ($assignment->uploads as $upload)
                        <span
                            class="px-3 py-1 rounded-lg text-white text-sm font-medium
                                                    @if ($upload->status == 'submitted') bg-green-500
                                                    @elseif($upload->status == 'graded') bg-blue-500
                                                    @else bg-gray-500 @endif">
                            {{ ucfirst($upload->status) }}
                        </span>
                        @endforeach
                        @else
                        <span class="text-gray-500 text-sm">No uploads</span>
                        @endif
                    </span>
                </li>
                @endforeach
                @else
                <p class="text-center text-gray-500">No Assignments available</p>
                @endif
            </ul>
        </div>


        <!-- Notifications Section -->
        <div class="px-6 py-3  rounded-lg border border-slate-200 lg:col-span-1 h-[300px]">
            <h2 class="text-md font-medium mb-4 text-gray-600">Notifications</h2>
            <ul class="space-y-4 overflow-y-scroll">
                <li class="bg-gray-50 p-4 rounded-lg text-slate-700">New quiz available for "Data
                    Structures".</li>
                <li class="bg-gray-50 p-4 rounded-lg text-slate-700">Assignment 2 deadline extended.</li>
                <li class="bg-gray-50 p-4 rounded-lg text-slate-700">Web Dev project submissions start
                    next week.</li>

            </ul>
        </div>

        <!-- Quiz Scores -->
        <div class="text-gray-700 px-6 py-3 rounded-lg border border-slate-200 lg:col-span-1">
            <h2 class="text-md font-medium mb-4 text-gray-600">Last Quiz Scores</h2>
            <ul class="space-y-4">
                @forelse ($exams as $exam)
                <li class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                    <span class="text-white text-bold">📝 {{ $exam->exam->exam_name }}</span>
                    {{-- {{ dd($exam) }} --}}
                    <span class="text-blue-400 font-medium">{{ $exam->total_marks }}%</span>
                </li>
                @empty
                <p class="text-center text-gray-500">No Exam available</p>
                @endforelse
            </ul>
        </div>

        <!-- membership button -->
        

    </div>
</div>  
@endif
@endsection
@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@auth
<script>
   
    document.getElementById('membership-pay-button').onclick = function(e) {
        const payButton = document.getElementById('membership-pay-button');
        payButton.disabled = true;
        e.preventDefault();

        const receipt_no = `${Date.now()}`;
       

        // First, initiate payment by sending the details to the backend
        fetch("{{ route('store.payment.initiation') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    student_id: "{{ Auth::id() }}" ?? 99,
                    receipt_no: receipt_no,
                    amount: 700 ?? null,
                    ip_address: "{{ request()->ip() }}",
                    workshop_id:  null,  
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // console.log("check wp and crs id",data.workshop_id,data.course_id);
                    // Use the Razorpay order_id received from backend
                    var options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": 700 * 100, // amount in paise
                        "currency": "INR",
                        "name": "LearnSyntax",
                        "description": "Processing Fee",
                        "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                        "order_id": data.order_id, // Razorpay order ID
                        "handler": function(response) {
                            // After successful payment, send the payment details to the backend
                            fetch("{{ route('handle.payment.response') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({
                                        payment_id: data.payment_id, // Payment ID created in the backend
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                    })
                                })
                                .then(response => {
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        alert('Payment processed successfully');
                                        window.location.href = '/student/billing';
                                    } else {
                                        alert('Payment failed: ' + data.message);
                                        payButton.disabled = false;
                                    }
                                })
                                .catch(error => {
                                    console.error("Error in updating payment:", error);
                                    payButton.disabled = false;
                                });
                        },
                        "prefill": {
                            "name": "{{ Auth::user()->name }}",
                            "email": "{{ Auth::user()->email }}"
                        },
                        "theme": {
                            "color": "#0a64a3"
                        },
                        "modal": {
                            "ondismiss": function() {
                                alert('Payment process was cancelled.');
                                payButton.disabled = false;
                                document.forms[0].submit();
                            }
                        }
                    };

                    // Open the Razorpay payment modal
                    var rzp1 = new Razorpay(options);
                    rzp1.open();

                } else {
                    alert("Error initiating payment: " + data.message);
                    payButton.disabled = false;
                }
            })
            .catch(error => {
                console.error("Error initiating payment:", error);
                payButton.disabled = false;
            });
    };
</script>
@endauth
@endsection