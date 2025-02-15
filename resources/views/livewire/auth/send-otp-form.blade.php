<div>

    <div class="flex bg-white rounded-lg md:max-w-3xl mb-28 mt-28 shadow-xl border overflow-hidden mx-auto max-w-sm lg:w-full">
        <div class="hidden lg:block lg:w-1/2 bg-cover bg-center" style="background-image:url('{{ asset('assets/icons/loginimage.png') }}')"></div>
        <div id="otp-form" class="w-full p-8 lg:w-1/2">
            <form  wire:submit.prevent="sendotp" method="POST" id="send-otp-form" class="space-y-6">
                
                <div class="flex flex-col items-center text-center">
                    <img src="{{ asset('assets/LearnSyntax.png') }}" alt="Learn Syntax" class="h-10 mb-4">
                    <p class="text-sm text-gray-600">Welcome Students</p>
                </div>
                <div class="border-b w-full my-4"></div>

                <div>
                    <label for="otp_email" class="block text-gray-700 text-sm font-semibold mb-2">Enter your email for OTP</label>
                    <input type="email" wire:model="email" name="email" id="otp_email" placeholder="abc@gmail.com" class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-2.5 px-4 transition duration-300" required value="{{ session('useremail') }}">
                </div>
                <button type="submit" id="send-otp-btn" class="w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center">
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
                    Don't have an account? <a href="{{ route('auth.register') }}" class="text-blue-500 font-semibold hover:text-blue-700">Register Here</a>
                </p>
            </form>
        </div>
    </div>
</div>