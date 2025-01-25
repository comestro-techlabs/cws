@extends('public.layout')

@section('title')
Login
@endsection

@section('content')

<div class="flex bg-white rounded-lg md:max-w-3xl mb-12 mt-20 py-12 shadow-xl border overflow-hidden mx-auto max-w-sm lg:">
    <div class="hidden lg:block lg:w-1/2 bg-cover"
        style="background-image:url('{{ asset('assets/icons/loginimage.png') }}')">
    </div>

    <div id="otp-form" class="w-full p-12 lg:w-1/2">
        <form action="{{route('auth.sendOtp')}}" method="POST" id="send-otp-form">
            @csrf
            <h2 class="text-2xl font-semibold text-center"> <span class="text-primary font-bold">Learn</span><span
                    class="text-blue-600 font-bold">syntax</span></h2>

            <p class="text-xl text-gray-600 text-center">Welcome Students</p>

            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 lg:w-1/4"></span>
                <a href="#" class="text-xs text-center text-gray-500 uppercase">or login with email</a>
                <span class="border-b w-1/5 lg:w-1/4"></span>
            </div>
            <div class="mt-4">
                <label for="otp_email" class="block text-gray-700 text-sm font-bold mb-2">Enter your email for OTP</label>
                <input type="email" name="email" id="otp_email"
                    class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                    required value="{{ old('email') }}">
                @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Send
                    OTP</button>
            </div>
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 mt-2 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5 space-y-2">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 md:w-1/4"></span>
                <a href="{{ route('auth.register') }}" class="text-xs text-gray-500 uppercase">Apply TO Join Us</a>
                <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
        </form>
    </div>

<!-- OTP Modal -->
<div id="otp-modal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
       <div class="flex justify-between"> <h3 class="text-lg font-semibold text-gray-800">Enter OTP</h3>
        <button type="button" id="close-modal" class=" text-gray-700 "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg></button></div>

        <p class="text-sm text-gray-600 mb-4">An OTP has been sent to your email. Please enter it below:</p>

        <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" id="otp_email_hidden" value="{{ session('email') }}">

            <div>
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">OTP</label>
                <input type="text" name="otp" id="otp" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                    placeholder="Enter OTP" required>
                @error('otp')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Verify OTP</button>


            </div>
        </form>
        <form id="resend-otp-form" action="{{ route('auth.resend-otp') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <p class="text-sm text-gray-600 mt-4 text-center">
                Didn't receive the OTP?
            <button type="submit" class="text-blue-500 font-semibold">Resend OTP</button>
            </p>
        </form>
    </div>
</div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const otpModal = document.getElementById('otp-modal');
        const closeModalButton = document.getElementById('close-modal');

        // Show OTP modal if session has otp_sent
        @if (session('otp_sent'))
            otpModal.classList.remove('hidden');
        @endif

        // Hide OTP modal when close button is clicked
        closeModalButton.addEventListener('click', function () {
            otpModal.classList.add('hidden');
        });

        // Add event listener for Resend OTP form
        document.getElementById('resend-otp-form').addEventListener('submit', function () {
            // Before submitting, ensure modal stays open
            localStorage.setItem('keepModalOpen', 'true');
        });

        // Check localStorage to reopen modal after reload
        if (localStorage.getItem('keepModalOpen') === 'true') {
            otpModal.classList.remove('hidden');
            localStorage.removeItem('keepModalOpen'); // Clear the flag
        }
    });
</script>

@endsection
