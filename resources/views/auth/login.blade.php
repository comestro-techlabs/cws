@extends('public.layout')

@section('title')
Login
@endsection

@section('content')
<div class="flex bg-white rounded-lg md:max-w-3xl mb-28 mt-28 shadow-xl border overflow-hidden mx-auto max-w-sm lg:w-full">
    <!-- Left Image Section -->
    <div class="hidden lg:block lg:w-1/2 bg-cover bg-center" style="background-image:url('{{ asset('assets/icons/loginimage.png') }}')"></div>

    <!-- Login Form Section -->
    <div id="otp-form" class="w-full p-8 lg:w-1/2">
        <form action="{{route('auth.sendOtp')}}" method="POST" id="send-otp-form" class="space-y-6">
            @csrf
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('assets/LearnSyntax.png') }}" alt="Learn Syntax" class="h-10 mb-4">
                <p class="text-sm text-gray-600">Welcome Students</p>
            </div>

            <div class="border-b w-full my-4"></div>

            <div>
                <label for="otp_email" class="block text-gray-700 text-sm font-semibold mb-2">Enter your email for OTP</label>
                <input type="email" name="email" id="otp_email" placeholder="abc@gmail.com" class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-2.5 px-4 transition duration-300" required value="{{ old('email') }}">
            </div>

            <button type="submit" id="send-otp-btn" class="w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                <span id="send-otp-text">Send OTP</span>
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

<!-- OTP Modal -->
<div id="otp-modal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Enter OTP</h3>
            <button type="button" id="close-modal" class="text-gray-700 hover:text-gray-900 transition duration-300">&times;</button>
        </div>

        <p class="text-sm text-gray-600 mb-4">An OTP has been sent to your email. Please enter it below:</p>

        <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" id="otp_email_hidden" value="{{ session('email') }}">

            <div>
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">OTP</label>
                <input type="text" name="otp" id="otp" class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-2.5 px-4 transition duration-300" placeholder="Enter OTP" required>
                @error('otp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Verify OTP</button>
        </form>

        <form id="resend-otp-form" action="{{ route('auth.resend-otp') }}" method="POST">
            @csrf
            <p class="text-sm text-gray-600 mt-4 text-center">
                Didn't receive the OTP? <button type="submit" class="text-blue-500 font-semibold hover:text-blue-700">Resend OTP</button>
            </p>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sendOtpForm = document.getElementById("send-otp-form");
        const sendOtpBtn = document.getElementById("send-otp-btn");
        const sendOtpText = document.getElementById("send-otp-text");
        const loadingSpinner = document.getElementById("loading-spinner");
        const otpModal = document.getElementById('otp-modal');
        const closeModalButton = document.getElementById('close-modal');

        sendOtpForm.addEventListener("submit", function () {
            sendOtpBtn.disabled = true;
            sendOtpText.textContent = "Sending...";
            loadingSpinner.classList.remove("hidden");
        });

        @if (session('otp_sent'))
            otpModal.classList.remove('hidden');
        @endif

        closeModalButton.addEventListener('click', function () {
            otpModal.classList.add('hidden');
        });
    });
</script>

@endsection
