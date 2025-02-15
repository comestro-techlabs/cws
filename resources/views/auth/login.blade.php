@extends('public.layout')

@section('title')
Login
@endsection

@section('content')
   
<livewire:auth.send-otp-form :email="session('useremail')"/>

<!-- OTP Modal -->
<div id="otp-modal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Enter OTP</h3>
            <button type="button" id="close-modal" class="text-gray-700 hover:text-gray-900 transition duration-300">&times;</button>
        </div>

        <p class="text-sm text-gray-600 mb-4">An OTP has been sent to your email. Please enter it below:</p>

        <livewire:auth.otp-modal-form :email="session('email')"/>
       

        <!-- here we will write the livewire component -->
        <!-- <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" id="otp_email_hidden" value="{{ session('email') }}">

            <div>
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">OTP</label>
                <input type="text" name="otp" id="otp" class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-2.5 px-4 transition duration-300" placeholder="Enter OTP" required>
                @error('otp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Verify OTP</button>
        </form> -->

        <form id="resend-otp-form" action="{{ route('auth.resend-otp') }}" method="POST">
            @csrf
            <p class="text-sm text-gray-600 mt-4 text-center">
                Didn't receive the OTP? <button type="submit" class="text-blue-500 font-semibold hover:text-blue-700">Resend OTP</button>
            </p>
        </form>
    </div>
</div>
<!-- <script>
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


        closeModalButton.addEventListener('click', function () {
            otpModal.classList.add('hidden');
        });
    });
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeModalButton = document.getElementById('close-modal');
        const otpModal = document.getElementById('otp-modal');

        @if (session('otp_sent'))
            otpModal.classList.remove('hidden');
        @endif

        closeModalButton.addEventListener('click', function () {
            otpModal.classList.add('hidden');
        });
    });

    

</script>

@endsection
