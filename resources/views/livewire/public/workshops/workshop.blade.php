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

    <x-slot:title> 1 Day Workshops | Learn Syntax | Coding Classes in Purnea – C, C++, Python, JavaScript
        (Bihar)</x-slot>
        <x-slot:description> 1 Day Training Workshops - Learn Syntax in Purnea, Bihar offers expert-led courses in C,
            C++, Python, JavaScript, Web Development, DBMS, Bootstrap, and more. Start coding with hands-on training,
            real-world projects, and certification!</x-slot>

            <div class="bg-white overflow-x-hidden">
                <livewire:page-heading title="Welcome To My Workshop"
                    description="Dive into a space where creativity meets innovation. Learn, build, and transform ideas into impactful solutions through hands-on experience and expert guidance."
                    image="about-header.png" />

                <div class="p-2 sm:p-8 bg-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ml-4 md:ml-36">
                        @forelse ($workshops as $workshop)
                            <div class="flex flex-col rounded-lg p-5 bg-white relative">
                                <img src="{{ asset('storage/' . $workshop->image) }}" alt=""
                                    class="w-full h-64 object-cover object-top rounded mb-4">

                                <h3 class="text-xl font-semibold text-gray-900 mb-3 text-center">
                                    {{ $workshop->title }}
                                </h3>
                                <p class="text-gray-600 text-sm">Date: <span
                                        class="font-medium">{{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y') }}</span>
                                </p>
                                <p class="text-gray-600 text-sm">Time: <span
                                        class="font-medium">{{ $workshop->time }}</span></p>
                                <p class="text-gray-600 text-sm">Fees:
                                    @if ($workshop->fees > 0) ₹{{ $workshop->fees }} @else Free @endif
                                </p>
                                <button wire:click="share({{ $workshop->id }})"
                                    class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                                    Share
                                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </button>
                                @if (in_array($workshop->id, $userPayments))
                                    <p class="mt-4 text-indigo-600 font-medium text-center">Already Enrolled</p>
                                @elseif ($workshop->fees > 0)
                                    <button wire:click="initiatePayment({{ $workshop->id }})"
                                        class="mt-6 w-full bg-indigo-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-indigo-700 transition-colors flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                        </svg>
                                        Enroll Now
                                    </button>
                                @else
                                    <p class="mt-4 text-green-600 font-medium text-center">This workshop is free to join!</p>
                                    <a href="{{ route('workshop.enroll', $workshop->id) }}"
                                        class="mt-2 w-full bg-teal-500 text-white font-medium rounded-lg px-4 py-2 hover:bg-teal-600 transition-colors flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                        </svg>
                                        Enroll Now
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-xl shadow-md p-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h2 class="text-2xl font-bold text-gray-800 mt-4">No Workshops Available</h2>
                                <p class="text-gray-600 mt-2">Stay tuned for exciting new workshops! Check back soon or
                                    explore our
                                    other resources.</p>
                                <a href="/"
                                    class="mt-6 inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                    Come Back Later
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
</div>
</div>

@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('initializePayment', (data) => {
                const options = {
                    key: data.key,
                    amount: data.amount,
                    currency: "INR",
                    name: "LearnSyntax",
                    description: "Workshop: " + data.workshop_title,
                    order_id: data.order_id,
                    handler: function (response) {
                        @this.call('handlePayment', {
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature,
                            payment_id: data.payment_id
                        });
                    },
                    prefill: {
                        name: "{{ auth()->user()->name ?? '' }}",
                        email: "{{ auth()->user()->email ?? ''}}"
                    },
                    theme: {
                        color: "#2563EB"
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            });

            @this.on('showError', (data) => {
                alert(data.message);
            });
        });      
    </script>
@endpush
<script>
 document.addEventListener('livewire:initialized', function () {
            Livewire.on('shareWorkshop', (event) => {
                console.log('Share event received:', event);

                const data = Array.isArray(event) ? event[0] : event;
                const url = data.url || window.location.href;
                const title = data.title || 'Untitled Course';
                const image = data.image || '';

                const shareText = `${title}\n${url}\nImage: ${image}`;

                if (navigator.share) {
                    navigator.share({
                        title: title,
                        text: title,
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
@endpush