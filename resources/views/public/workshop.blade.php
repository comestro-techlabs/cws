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

        <div class="p-2 sm:p-8 bg-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6  ml-4 md:ml-36">
                @forelse ($workshops as $workshop)
                    <div class="flex flex-col items-center rounded-lg p-5  bg-white relative">
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
                        @if (in_array($workshop->id, $userPayments))
                        <p class="mt-4 text-blue-600 font-medium">Already Enrolled</p>

                        @elseif ($workshop->fees > 0)
                            <button id="pay-button-{{ $workshop->id }}"
                                class="bg-blue-600 mt-8 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors"                                data-workshop-id="{{ $workshop->id }}"> 
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <span>Enroll Now</span>
                                </div>
                            </button>
                        @else
                            <p class=" text-green-600 font-medium">This workshop is free to join!</p>
                            <a href="{{ route('workshop.enroll', $workshop->id) }}" class="bg-blue-600 mt-4 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors">
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <span>Enroll Now</span>
                                </div>
                            </a>
                            </button>
                        @endif

                    </div>
                    @empty
            </div>
                    <div
                        class="flex flex-col items-center justify-center col-span-1 md:col-span-3 p-8 bg-gray-100 rounded-lg text-center">

                        <h2 class="text-gray-800 text-2xl md:text-3xl font-bold mb-2">
                            No Workshops Available
                        </h2>

                        <p class="text-gray-600 text-lg md:text-xl">
                            We're constantly adding new and exciting workshops to help you enhance your skills and
                            knowledge. Stay
                            tuned for upcoming sessions covering the latest in technology, programming, and more!
                        </p>

                        <p class="text-gray-600 text-md md:text-lg mt-2">
                            Meanwhile, explore our other resources and keep learning at your own pace. Your journey to
                            growth starts
                            here.
                        </p>

                        <a href="/"
                            class="mt-6 px-6 py-3 bg-purple-800 text-white text-lg font-medium rounded-lg hover:bg-purple-900 transition duration-300 shadow">
                            Come Back Again
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @auth
        @if (count($workshops))
            <script>
                document.querySelectorAll('[id^="pay-button-"]').forEach(button => {
                    button.onclick = function(e) {
                        const payButton = button;
                        payButton.disabled = true;
                        e.preventDefault();

                        const receipt_no = `${Date.now()}`;
                        const workshopId = payButton.getAttribute(
                            'data-workshop-id'); // Get the workshop id dynamically
                        console.log(workshopId); // Now it will log the correct id of the clicked workshop

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
                                    amount: "{{ $workshop->fees }}" ?? null,
                                    ip_address: "{{ request()->ip() }}",
                                    workshop_id: workshopId, // Send the correct workshop id to backend
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Use the Razorpay order_id received from backend
                                    var options = {
                                        "key": "{{ env('RAZORPAY_KEY') }}",
                                        "amount": "{{ $workshop->fees }}" * 100, // amount in paise
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
                                                        payment_id: data
                                                            .payment_id, // Payment ID created in the backend
                                                        razorpay_payment_id: response
                                                            .razorpay_payment_id,
                                                        razorpay_order_id: response
                                                            .razorpay_order_id,
                                                        razorpay_signature: response
                                                            .razorpay_signature,
                                                    })
                                                })
                                                .then(response => {
                                                    console.log('Response from backend:', response);
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
                });
            </script>
        @endif

    @endauth
@endsection
