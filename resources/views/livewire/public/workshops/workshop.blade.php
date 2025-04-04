<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <x-slot:title> 1 Day Workshops | Learn Syntax | Coding Classes in Purnea – C, C++, Python, JavaScript (Bihar)</x-slot>
    <x-slot:description> 1 Day Training Workshops - Learn Syntax in Purnea, Bihar offers expert-led courses in C, C++, Python, JavaScript, Web Development, DBMS, Bootstrap, and more. Start coding with hands-on training, real-world projects, and certification!</x-slot>

    <div class="bg-white overflow-x-hidden">
        <livewire:page-heading title="Welcome To My Workshop"
            description="Dive into a space where creativity meets innovation. Learn, build, and transform ideas into impactful solutions through hands-on experience and expert guidance."
            image="about-header.png" />

        <div class="p-2 sm:p-8 bg-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ml-4 md:ml-36">
                @forelse ($workshops as $workshop)
                    <a wire:navigate href="{{ route('workshops.view', $workshop->id) }}" class="block">
                        <div class="flex flex-col rounded-lg p-5 bg-white relative hover:shadow-lg transition-shadow">
                            <img src="{{ asset('storage/' . $workshop->image) }}" alt=""
                                class="w-full h-64 object-cover object-top rounded mb-4">

                            <h3 class="text-xl sm:text-2xl font-semibold text-black mb-2 text-center">
                                {{ $workshop->title }}
                            </h3>

                            <p class="text-gray-600">Date: <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($workshop->date)->format('F j, y') }}</span>
                            </p>
                            <p class="text-gray-600">Time: <span class="font-medium">{{ $workshop->time }}</span></p>

                            <p class="text-gray-600">Fees:
                                @if ($workshop->fees > 0)
                                    ₹{{ $workshop->fees }}
                                @else
                                    Free
                                @endif
                            </p>

                            @if (!Auth::check())
                                <button disabled
                                    class="bg-gray-400 mt-4 text-white font-medium rounded-lg px-4 py-2 cursor-not-allowed">
                                    <div class="flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg>
                                        <span>Please Login to Enroll</span>
                                    </div>
                                </button>
                            @elseif (in_array($workshop->id, $userPayments))
                                <button disabled
                                    class="bg-green-600 mt-4 text-white font-medium rounded-lg px-4 py-2 cursor-not-allowed">
                                    <div class="flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <span>Already Enrolled</span>
                                    </div>
                                </button>
                            @elseif ($workshop->fees > 0)
                                <button wire:click.prevent="initiatePayment({{ $workshop->id }})"
                                    class="bg-blue-600 mt-8 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors">
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
                                <a href="{{ route('workshop.enroll', $workshop->id) }}"
                                    class="bg-blue-600 mt-4 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors">
                                    <div class="flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                        </svg>
                                        <span>Enroll Now</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center col-span-1 md:col-span-3 p-8 bg-gray-100 rounded-lg text-center">
                        <h2 class="text-gray-800 text-2xl md:text-3xl font-bold mb-2">
                            No Workshops Available
                        </h2>
                        <p class="text-gray-600 text-lg md:text-xl">
                            We're constantly adding new and exciting workshops to help you enhance your skills and knowledge. Stay tuned for upcoming sessions covering the latest in technology, programming, and more!
                        </p>
                        <p class="text-gray-600 text-md md:text-lg mt-2">
                            Meanwhile, explore our other resources and keep learning at your own pace. Your journey to growth starts here.
                        </p>
                        <a href="/" class="mt-6 px-6 py-3 bg-purple-800 text-white text-lg font-medium rounded-lg hover:bg-purple-900 transition duration-300 shadow">
                            Come Back Again
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('initWorkshopPayment', (data) => {
            console.log('Raw workshop payment event data:', data);

            if (!Array.isArray(data) || !data[0]) {
                console.error('Invalid payment data structure:', data);
                return;
            }

            const paymentData = data[0]; // Access first element
            console.log('Workshop payment data:', paymentData);

            if (!paymentData || typeof paymentData !== 'object') {
                console.error('Payment data is not an object:', paymentData);
                return;
            }

            const options = {
                "key": paymentData.key,
                "amount": paymentData.amount,
                "currency": "INR",
                "name": "LearnSyntax",
                "description": `Workshop: ${paymentData.workshop_title}`,
                "order_id": paymentData.order_id,
                "handler": function (response) {
                    console.log('Payment success:', response);
                    @this.call('handlePaymentSuccess', response);
                },
                "prefill": {
                    "name": paymentData.prefill.name,
                    "email": paymentData.prefill.email
                },
                "theme": {
                    "color": "#2563EB"
                }
            };

            console.log('Razorpay options:', options);

            try {
                const rzp = new Razorpay(options);
                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response);
                    @this.call('handlePaymentCancelled');
                });
                rzp.open();
            } catch (error) {
                console.error('Razorpay initialization error:', error);
                @this.dispatch('showError', { message: 'Payment initialization failed.' });
            }
        });

        Livewire.on('showError', (data) => {
            alert(data.message);
        });

        Livewire.on('paymentCompleted', () => {
            console.log('Payment completed, refreshing page');
            window.location.reload();
        });
    });
</script>