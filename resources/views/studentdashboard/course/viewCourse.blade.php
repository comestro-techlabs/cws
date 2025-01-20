@extends('studentdashboard.include.base')
@section('content')

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page">
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-lg-8">
                <div class="page__heading mb-6 border-bottom">
                    <div class="container page__container d-flex align-items-center">
                        <h1 class="mb-0">{{$course->title}}</h1>
                    </div>
                </div>

                <!-- Course Image Preview -->
                <a href="#" class="dp-preview card">
                    <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="Course Image" class="img-fluid" style="height: 80%">
                    <span class="dp-preview__overlay">
                        <span class="btn btn-light">Preview</span>
                    </span>
                </a>

                <!-- Course Description -->
                <div class="mb-3">
                    <strong class="text-dark-gray">DESCRIPTION</strong>
                </div>
                <p class="mb-3">{{$course->description}}</p>

                <!-- Course Chapters List -->
                <div>
                    @foreach ($course->chapters as $item)
                        <ul class="list-group list-lessons">
                            <li class="list-group-item d-flex">
                                <a href="#">{{$item->id}}.{{$item->title}}</a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Course Payment Details -->
                <div class="card card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-body" data-toggle="dropdown">{{$course->duration}} Month</a>
                            <div class="dropdown-menu py-0">
                                <div class="dropdown-item py-3 border-bottom d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span>Month</span>
                                        <strong class="ml-auto h4 m-0">₹{{$course->discounted_fees}}</strong>
                                    </div>
                                    <ul class="pl-4 mb-2 text-muted">
                                        <li>Use for {{$course->duration}} months</li>
                                        @foreach ($course->batches as $batch)
                                            <li>{{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }} to {{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}</li>
                                        @endforeach
                                    </ul>
                                    <small class="text-muted">Read more about <a href="#">Subscriptions</a></small>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto h2 mb-0"><strong>₹{{$course->discounted_fees}}</strong></div>
                    </div>

                    <!-- Payment Options -->
                    <div class="mb-4">
                        <form action="{{route('phonepe.initiate')}}" method="post">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="amount" value="{{$course->discounted_fees}}">
                            <button type="submit" class="flex items-center justify-center text-black rounded-full mt-2 shadow-xl px-6 py-3 w-full">
                                <img src="https://img.icons8.com/?size=100&id=OYtBxIlJwMGA&format=png&color=000000" alt="PhonePe Logo" class="w-8 h-8 object-contain">
                                <span>Proceed with PhonePe</span>
                            </button>
                        </form>

                        <!-- Razorpay Button -->
                        <a href="{{route('phonepe.payment')}}" id="pay-button" class="flex items-center justify-center bg-success text-white rounded-full mt-2 shadow-xl px-6 py-2">
                            <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png" alt="Razorpay Logo" class="w-12 h-12 object-cover">
                            <span>Proceed with Razorpay</span>
                        </a>
                    </div>
                </div>

                <!-- Course Features -->
                <div class="card card-body mb-0 bg-dark">
                    <ul class="list-unstyled text-white ml-1 mb-0">
                        @foreach ($course->features as $feature)
                            <li class="d-flex align-items-center pb-1"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> {{ $feature->name }}</li>
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
</div>

@endsection
