@extends('public.layout')

@section('title')
    Workshop
@endsection

@section('meta')
    <meta name="description"
        content="Discover Learn Syntax, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies." />
@endsection

@section('content')
    <div class="bg-white overflow-x-hidden">
        <livewire:page-heading title="Welcome To My Workshop"
    description="Dive into a space where creativity meets innovation. Learn, build, and transform ideas into impactful solutions through hands-on experience and expert guidance."
    image="about-header.png" />

        <div class="p-4 sm:p-8 bg-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($workshops as $workshop)
                    <div
                        class="flex flex-col items-center transform transition duration-300 hover:scale-105 hover:bg-gray-50 rounded-lg p-5 shadow-lg bg-white relative">
                        <img src="{{ asset('storage/' . $workshop->image) }}" alt=""
                            class="w-full h-64 object-cover object-top rounded mb-4">

                        <h3 class="text-xl sm:text-2xl font-semibold text-black mb-2 text-center">{{ $workshop->title }}
                        </h3>

                        <p class="text-gray-600 text-center">Date: <span
                                class="font-medium">{{ \Carbon\Carbon::parse($workshop->date)->format('F j, y') }}</span>
                        </p>
                        <p class="text-gray-600 text-center">Time: <span
                                class="font-medium">{{ \Carbon\Carbon::parse($workshop->time)->format('h:i, A') }}</span>
                        </p>
                        
                        <p class="text-gray-600 text-center">Fees: 
                            @if ($workshop->fees > 0)
                                ₹{{ $workshop->fees }}
                            @else
                                Free
                            @endif
                        </p>
                        
                        @if ($workshop->fees > 0)
                        <form action="{{ route('save.workshop.payment') }}" method="post" role="form">
                            @csrf
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id"
                                value="razorpay_payment_id">
                            <input type="hidden" name="workshop_id" value="{{ $workshop->id }}">

                            <input type="hidden" name="amount" value="{{ $workshop->fees }}">
                         
                            <button type="submit" id="pay-button-{{ $workshop->id }}"
                                class="mt-4 w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                                Buy Now
                            </button>



                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

                            <script>
                                document.getElementById('pay-button-{{ $workshop->id }}').onclick = function(e) {
                                    e.preventDefault();
                                    var form = this.closest('form'); 
                                    var options = {
                                        "key": "{{ env('RAZORPAY_KEY') }}",
                                        "amount": {{ $workshop->fees }} * 100,
                                        "currency": "INR",
                                        "name": "Learn Syntax",
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
                        @else
                        <p class="mt-4 text-green-600 font-medium">This workshop is free to join!</p>
                    @endif

                    </div>

                @empty

                <div class="flex flex-col items-center justify-center col-span-1 md:col-span-3 p-8 bg-gray-100">
                    <img src="https://img.freepik.com/premium-photo/presentation-office-business-people-meeting-teamwork-discussion-feedback-creative-company-startup-men-women-with-whiteboard-planning-collaboration-project-ideas_590464-454492.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_hybrid" 
                         alt="No workshops available" 
                         class="w-64 h-64 mb-4">
                    <h2 class="text-gray-800 text-2xl font-bold mb-2">No Workshops Available</h2>
                    <p class="text-gray-600 text-lg text-center">
                        We're constantly adding new and exciting workshops to help you enhance your skills and knowledge. Stay tuned for upcoming sessions covering the latest in technology, programming, and more!
                    </p>
                    <p class="text-gray-600 text-md text-center mt-2">
                        Meanwhile, feel free to explore our other resources and learn at your own pace. Your journey to growth starts here.
                    </p>
                    <a href="/" 
                       class="mt-6 px-6 py-2 bg-secondary text-white text-lg font-medium rounded-lg hover:bg-indigo-700 transition">
                        Go to Homepage
                    </a>
                </div>
                
              
                
                
            @endforelse
        </div>
            </div>
        </div>
    </div>
@endsection
