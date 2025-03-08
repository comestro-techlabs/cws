<div>
    <div class="flex bg-white rounded-lg md:max-w-3xl mb-28 mt-28 shadow-xl border overflow-hidden mx-auto max-w-sm lg:w-full">
        <div class="hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat" style="background-image:url('{{ asset('assets/icons/loginimage.png') }}')"></div>
        <div id="otp-form" class="w-full p-8 lg:w-1/2">
        @if (!session('otp_sent'))
            <form wire:submit.prevent="sendotp" method="POST" id="send-otp-form" class="space-y-6">
                
                <div class="flex flex-col items-center text-center">
                    <img src="{{ asset('assets/LearnSyntax.png') }}" alt="Learn Syntax" class="h-12 mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Welcome Back!</h2>
                    <p class="text-sm text-gray-600">Enter your email to receive an OTP</p>
                </div>
                <div class="border-b w-full my-6 border-gray-200"></div>

                <div>
                    <label for="otp_email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" wire:model="email" name="email" id="otp_email" placeholder="abc@gmail.com" 
                            class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 border border-gray-200 rounded-lg py-3 px-4 pl-10 transition duration-200" 
                            required value="{{ session('useremail') }}">
                        <span class="absolute left-3 top-3.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                    </div>
                </div>
                <button type="submit" id="send-otp-btn" class="w-full bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 flex items-center justify-center gap-2">
                    <span id="send-otp-text">Send OTP<span wire:loading>...</span></span>
                    <span id="loading-spinner" class="hidden ml-2 w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                </button>

                @if ($errors->any())
                <div class="bg-red-50 border-l-4 mt-2 border-red-500 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc pl-5 space-y-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <p class="text-sm text-gray-600 text-center">
                    Don't have an account? <a href="{{ route('auth.register') }}" class="text-purple-700 font-semibold hover:text-purple-800">Register Here</a>
                </p>
            </form>
        @else
        <div class="min-h-[320px] flex flex-col">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Enter OTP</h2>
                <p class="text-sm text-gray-600">We've sent a verification code to your email</p>
            </div>
            <div class="flex-grow">
                <livewire:auth.otp-modal-form :email="session('email')"/>
            </div>
            <form id="resend-otp-form" action="{{ route('auth.resend-otp') }}" method="POST" class="mt-6">
                @csrf
                <p class="text-sm text-gray-600 text-center">
                    Didn't receive the code? <button type="submit" class="text-purple-700 font-semibold hover:text-purple-800">Resend OTP</button>
                </p>
            </form>
        </div>
        @endif
        </div>
    </div>
</div>