<div>

    <x-slot:title> 1 Day Workshops | Learn Syntax | Coding Classes in Purnea – C, C++, Python, JavaScript
        (Bihar)</x-slot>
        <x-slot:description> 1 Day Training Workshops - Learn Syntax in Purnea, Bihar offers expert-led courses in C,
            C++, Python, JavaScript, Web Development, DBMS, Bootstrap, and more. Start coding with hands-on training,
            real-world projects, and certification!</x-slot>

            <div class="bg-white overflow-x-hidden">
                <livewire:page-heading title="Welcome To My Workshop"
                    description="Dive into a space where creativity meets innovation. Learn, build, and transform ideas into impactful solutions through hands-on experience and expert guidance."
                    image="about-header.png" />

                <div class="p-4 sm:p-8 bg-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($workshops as $workshop)
                            <div class="flex flex-col rounded-lg p-5 bg-white shadow-md hover:shadow-lg transition-shadow">
                                <a wire:navigate href="{{ route('workshops.view', $workshop->id) }}" class="block">
                                    <img src="{{ asset('storage/' . $workshop->image) }}" alt="{{ $workshop->title }}"
                                        class="w-full h-64 object-cover object-top rounded mb-4">
                                </a>
                                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2 text-center">
                                    {{ $workshop->title }}
                                </h3>

                                <!-- Share Button -->


                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <p class="text-gray-600 text-sm mb-1">Date: <span
                                                class="font-medium">{{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y') }}</span>
                                        </p>
                                        <p class="text-gray-600 text-sm mb-1">Time: <span
                                                class="font-medium">{{ $workshop->time }}</span></p>
                                        <p class="text-gray-600 text-sm mb-4">Fees:
                                            @if ($workshop->fees > 0)
                                                <span class="font-medium text-green-600">₹{{ $workshop->fees }}</span>
                                            @else
                                                <span class="font-medium text-blue-600">Free</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-between space-x-2">
                                        @if (!Auth::check())
                                            <button 
                                                class="bg-purple-600 text-white font-medium rounded-lg px-4 py-2 cursor-not-allowed">
                                                <a wire:navigate href="{{ route('auth.login') }}">Login To Enroll</a>
                                            </button>
                                        @elseif (in_array($workshop->id, $userPayments))
                                            <button disabled
                                                class="bg-gray-500 text-white font-medium rounded-lg px-4 py-2 cursor-not-allowed">
                                                Already Enrolled
                                            </button>
                                        @elseif ($workshop->fees > 0)
                                            <button wire:click.prevent="initiatePayment({{ $workshop->id }})"
                                                class="bg-blue-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors">
                                                Enroll Now
                                            </button>
                                        @else
                                            <a href="{{ route('workshop.enroll', $workshop->id) }}"
                                                class="bg-blue-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors">
                                                Enroll Now
                                            </a>
                                        @endif

                                        <button wire:click="share({{ $workshop->id }})"
                                            class="inline-flex items-center justify-center px-3 py-2 rounded-lg text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="flex flex-col items-center justify-center col-span-1 md:col-span-3 p-8 bg-gray-100 rounded-lg text-center">
                                <h2 class="text-gray-800 text-2xl md:text-3xl font-bold mb-2">
                                    No Workshops Available
                                </h2>
                                <p class="text-gray-600 text-lg md:text-xl">
                                    We're constantly adding new and exciting workshops to help you enhance your skills and
                                    knowledge. Stay tuned for upcoming sessions covering the latest in technology,
                                    programming, and more!
                                </p>
                                <p class="text-gray-600 text-md md:text-lg mt-2">
                                    Meanwhile, explore our other resources and keep learning at your own pace. Your journey
                                    to growth starts here.
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
                                @this.dispatch('redirectToDashboard');

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

                document.addEventListener('livewire:initialized', function () {
                    Livewire.on('shareWorkshop', (event) => {
                        console.log('Share event received:', event);

                        const data = Array.isArray(event) ? event[0] : event;
                        const url = data.url || window.location.href;
                        const title = data.title || 'Untitled workshop';
                        const image = data.image || '';

                        const shareText = `${title}\n${url}\nImage: ${image}`;

                        if (navigator.share) {
                            navigator.share({
                                title: title,
                                text: `${title}`,
                                url: url,
                            })
                                .then(() => console.log('Shared successfully'))
                                .catch((error) => console.log('Error sharing:', error));
                        } else {
                            navigator.clipboard.writeText(shareText)
                                .then(() => {
                                    alert(`Copied to clipboard:\n${shareText}`);
                                })
                                .catch((error) => {
                                    console.log('Error copying:', error);
                                    alert(`Failed to copy. Here’s the info:\n${shareText}`);
                                });
                        }
                    });
                });
            </script>