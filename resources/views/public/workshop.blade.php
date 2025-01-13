@extends('public.layout')

@section('title')
    Workshop
@endsection

@section('meta')
    <meta name="description"
        content="Discover Comestro, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies." />
@endsection

@section('content')
    <div class="bg-white overflow-x-hidden">
        <livewire:page-heading title="Welcome To My Workshop"
            description="Our TechLab services in India enhance your brand’s online presence, attract new customers, and drive conversions."
            image="about-header.png" />


        <div class="p-4 sm:p-8 bg-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($workshops as $workshop)
                    <div
                        class="flex flex-col items-center transform transition duration-300 hover:scale-105 hover:bg-gray-50 rounded-lg p-5 shadow-lg bg-white relative">
                        <img src="{{ asset('storage/' . $workshop->image) }}" alt="{{ $workshop->title }}"
                            class="w-full h-64 object-cover object-top rounded mb-4">

                        <h3 class="text-xl sm:text-2xl font-semibold text-black mb-2 text-center">{{ $workshop->title }}
                        </h3>

                        <p class="text-gray-600 text-center">Date: <span
                                class="font-medium">{{ \Carbon\Carbon::parse($workshop->date)->format('F j, y') }}</span>
                        </p>
                        <p class="text-gray-600 text-center">Time: <span
                                class="font-medium">{{ \Carbon\Carbon::parse($workshop->time)->format('h:i, A') }}</span>
                        </p>
                        <p class="text-gray-600 text-center">Fees: {{ $workshop->fees }}</p>

                        <form action="{{ route('save.workshop.payment') }}" method="post" role="form">
                            @csrf
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id"
                                value="razorpay_payment_id">
                            <input type="hidden" name="workshop_id" value="{{ $workshop->id }}">

                            <input type="hidden" name="amount" value="{{ $workshop->fees }}">
                            {{-- <button type="submit" id="pay-button" class="mt-4 w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Buy Now
                    </button> --}}
                            <button type="submit" id="pay-button-{{ $workshop->id }}"
                                class="mt-4 w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                                Buy Now
                            </button>



                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                            {{-- <script>
                       document.getElementById('pay-button').onclick = function(e) {
                           e.preventDefault();
                           var options = {
                            //    "key": "{ env('RAZORPAY_KEY') } ",
                            "key": "{{ env('RAZORPAY_KEY') }}",
                               "amount": {{ $workshop->fees }} * 100,
                               "currency": "INR",
                               "name": "Comestro",
                               "description": "Workshop Fee Payment",
                               "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                               "handler": function(response) {
                                   document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                                   document.forms[0].submit();
                               },
                               "prefill": {
                                   "name": "",
                                   "email": "",
                                   "contact": ""
                               },
                               "theme": {
                                   "color": "#0a64a3"
                               }
                           };
                           var rzp1 = new Razorpay(options);
                           rzp1.open();
                       }
                      
               
                   </script>  --}}
                            <script>
                                document.getElementById('pay-button-{{ $workshop->id }}').onclick = function(e) {
                                    e.preventDefault();
                                    var form = this.closest('form'); 
                                    var options = {
                                        "key": "{{ env('RAZORPAY_KEY') }}",
                                        "amount": {{ $workshop->fees }} * 100,
                                        "currency": "INR",
                                        "name": "Comestro",
                                        "description": "Workshop Fee Payment",
                                        "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                                        "handler": function(response) {
                                            form.querySelector('#razorpay_payment_id').value = response.razorpay_payment_id;
                                            form.submit();
                                        },
                                        "prefill": {
                                            "name": "",
                                            "email": "",
                                            "contact": ""
                                        },
                                        "theme": {
                                            "color": "#0a64a3"
                                        }
                                    };
                                    var rzp1 = new Razorpay(options);
                                    rzp1.open();
                                };
                            </script>


                        </form>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
