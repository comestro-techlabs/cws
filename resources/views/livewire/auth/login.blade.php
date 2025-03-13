<div class="flex bg-white rounded-lg md:max-w-3xl mb-28 mt-28 shadow-xl border overflow-hidden mx-auto max-w-sm lg:w-full">
    <div class="hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat" style="background-image:url('{{ asset('assets/icons/loginimage.png') }}')"></div>
    <div class="w-full p-8 lg:w-1/2">
        @if (!$isSendOtp)
            <form wire:submit="save" class="space-y-6">
                <div class="flex flex-col items-center text-center">
                    <img src="{{ asset('assets/LearnSyntax.png') }}" alt="Learn Syntax" class="h-12 mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Welcome Back!</h2>
                    <p class="text-sm text-gray-700">Enter your email to receive an OTP</p>
                </div>
                <div class="border-b w-full my-6 border-gray-200"></div>

                <div>
                    <label for="otp_email" class="block text-gray-700 text-sm font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" wire:model="email" id="otp_email" placeholder="abc@gmail.com"
                            class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-3 px-4 pl-10 transition duration-200"
                            required value="{{ session('useremail') }}">
                        <span class="absolute left-3 top-3.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center justify-center gap-2"
                    @class(['opacity-75 cursor-wait' => $errors->any()])>
                    <span wire:loading.remove>Send OTP</span>
                    <span wire:loading>Sending...</span>
                    <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
                @livewire('auth.google-login')
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror

                <p class="text-sm text-gray-700 text-center">
                    Don't have an account? <a href="{{ route('auth.register') }}" class="text-blue-600 font-semibold hover:text-blue-700">Register Here</a>
                </p>
            </form>
        @else
            <div class="min-h-[320px] flex flex-col">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Enter OTP</h2>
                    <p class="text-sm text-gray-700">We've sent a verification code to your email</p>
                </div>
                <div class="flex-grow">
                    <form wire:submit.prevent="verifyotp" class="space-y-6">
                        <div>
                            <label for="otp" class="block text-gray-700 text-sm font-medium mb-2">Verification Code</label>
                            <div class="relative">
                                <input type="text" wire:model="otp" id="otp"
                                    class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-3 px-4 pl-10 transition duration-200"
                                    placeholder="Enter 6-digit code"
                                    maxlength="6"
                                    pattern="\d{6}"
                                    required>
                                <span class="absolute left-3 top-3.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </span>
                            </div>
                            @error('otp')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center justify-center gap-2"
                            @class(['opacity-75 cursor-wait' => $errors->any()])>
                            <span wire:loading.remove>Verify Code</span>
                            <span wire:loading>Verifying...</span>
                            <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
