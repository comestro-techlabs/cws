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
                <a href="#" class="dp-preview card">
                    <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="digital product" class="img-fluid " style="height: 80%">
                    <span class="dp-preview__overlay">
                        <span class="btn btn-light">Preview</span>
                    </span>
                </a>
                <div class="mb-3"><strong class="text-dark-gray">DESCRIPTION</strong></div>
                <p class="mb-3">
                    {{$course->description}} 
                 </p>


                <div class="">
                    @foreach ($course->chapters as $item)
                    <ul class="list-group list-lessons">
                        <li class="list-group-item d-flex">
                            <a href="fixed-#">{{$item->id}}.{{$item->title}}</a>
                            <div class="ml-auto d-flex align-items-center">
                                {{-- <span class="badge badge-success mr-2">FREE</span> --}}
                                {{-- <span class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</span> --}}
                            </div>
                        </li>
                        
                      
                    </ul>
                    @endforeach
                   
                </div>
                {{-- <div class="bg-white rounded-lg p-6 border-left border-top border-bottom border-right border-secondary">
                    <h2 class="text-2xl font-weight-bold text-primary mb-4">Course Content</h2>
                    <div id="accordion" class="accordion">
                        @foreach ($course->chapters as $chapter)
                        <div class="card">
                            <div class="card-header" id="heading{{ $loop->index }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link d-flex justify-content-between w-100 text-left font-weight-bold text-dark"
                                        type="button" data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                                        aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                        <span>{{ $chapter->title }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" fill="none" viewBox="0 0 10 6" class="rotate-180">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5L5 1 1 5" />
                                        </svg>
                                    </button>
                                </h5>
                            </div>
                
                            <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion">
                                <div class="card-body px-4 py-2 text-sm text-dark">
                                    @foreach ($chapter->lessons as $lesson)
                                    <a href="#" class="d-flex align-items-center text-dark py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2" style="width: 20px; height: 20px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                        </svg>
                                        {{ $lesson->title }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> --}}
                
            </div>
            <div class="col-lg-4">
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
                                        <li>Use for a {{$course->duration}} month</li>
                                        @foreach ($course->batches as $batch)
                                        <li> {{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }} to
                                            {{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}</li>
                                            
                                        @endforeach
                                    </ul>
                                    <small class="text-muted">Read more about <a href="#">Subscriptions</a></small>
                                </div>
                                {{-- <div class="dropdown-item py-3 d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span>Yearly</span>
                                        <span class="ml-auto h4 m-0">$599.00</span>
                                    </div>
                                    <ul class="pl-4 mb-2 text-muted">
                                        <li>Use for a year</li>
                                        <li>PRO acces to app</li>
                                    </ul>
                                    <small class="text-muted">Read more about <a href="#">Subscriptions</a></small>
                                </div> --}}
                            </div>
                        </div>
                        <div class="ml-auto h2 mb-0"><strong>₹{{$course->discounted_fees}}</strong></div>
                    </div>

                    <div class="mb-4">
                       
                        <form action="{{route('phonepe.initiate')}}" class="w-full" method="post" role="form">
                            @csrf
                            <input type="hidden" name="name" id="" value="{{Auth::user()->name}}">
                            <input type="hidden" name="email" id="" value="{{Auth::user()->email}}">
                            <input type="hidden" value="{{ $course->id }}" name="course_id" id="course_id">
                            <input type="hidden" value="{{Auth::user()->contact}}" name="mobile_number" id="mobile_number">
                            <input type="hidden" value="{{$course->discounted_fees}}" name="amount" id="amount">
                            <button type="submit" target="_blank"
                                class="flex items-center justify-center  text-black  rounded-full mt-2 shadow-xl px-6 py-3 w-full transition duration-300 ease-in-out transform hover:scale-105 space-x-3">
                                <img src="https://img.icons8.com/?size=100&id=OYtBxIlJwMGA&format=png&color=000000"
                                    alt="PhonePe Logo" class="w-8 h-8 object-contain">
                                <span>Proceed with PhonePe</span>
                            </button>
        
                        </form>
        
                        <a href="{{route('phonepe.payment')}}" id="pay-button"
                            class="flex items-center justify-center bg-success text-white  rounded-full mt-2 shadow-xl px-6 py-2  transition duration-300 ease-in-out transform hover:scale-105 space-x-3">
                            <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png?f=webp&w=256"
                                alt="PhonePe Logo" class="w-12 h-12 object-cover">
                            <span class="">Proceed with Razorpay</span>
                        </a>
                       
        
                      
                        {{-- <a href="{{route('phonepe.payment')}}"></a><button class="btn btn-success btn-block btn-lg">Purchase</button> --}}
                        {{-- <button class="btn btn-light btn-block">Preview</button> --}}
                    </div>

                    {{-- <div class="mb-4 text-center">
                        <div class="d-flex flex-column align-items-center justify-content-center">

                            <span class="mb-1">
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                            </span>
                            <div class="d-flex align-items-center">
                                <strong>4.7/5</strong>
                                <span class="text-muted ml-1">&mdash; 4 reviews</span>
                            </div>

                        </div>
                    </div> --}}

                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Level</strong>
                            <div class="ml-auto">Beginner</div>
                        </div>
                        @foreach ($course->batches as $batch)

                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Released</strong>
                            <div class="ml-auto">{{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }} </div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Total Seats</strong>
                            <div class="ml-auto">{{$batch->total_seats}}</div>
                        </div> 
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Available Seats</strong>
                            <div class="ml-auto">{{$batch->available_seats}}</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="card card-body mb-0 bg-dark">
                        <ul class="list-unstyled text-white ml-1 mb-0">
                            @foreach ($course->features as $feature)

                            <li class="d-flex align-items-center pb-1"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> {{ $feature->name }}</li>
                            {{-- <li class="d-flex align-items-center pb-1"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> 6 Months Support</li> --}}
                            {{-- <li class="d-flex align-items-center"><i class="material-icons icon-16pt text-white mr-2">check_circle</i> 100% Money Back Guarantee</li> --}}
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('save.course.payment') }}" method="post" role="form">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">
    <input type="hidden" value="{{ $course->id }}" name="course_id" id="course_id">
    <input type="hidden" value="{{ $course->discounted_fees }}" name="amount" id="amount">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @auth

    <script>
        document.getElementById('pay-button').onclick = function(e) {
            e.preventDefault();
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": "{{ $course->discounted_fees }}" * 100,
                "currency": "INR",
                "name": "Comestro",
                "description": "Processing Fee",
                "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                "handler": function(response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.forms[0].submit();
                },
                "prefill": {
                    "name": "{{ Auth::user()->name }}",
                    "email": "{{ Auth::user()->email }}",
                    // "contact": {{ Auth::user()->contact }}
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
<!-- // END Header Layout Content -->
@endsection
