@extends('public.layout')

@section('title')
    Login
@endsection

@section('content')
<div class="max-w-lg mx-auto p-6 border rounded-md shadow-md">
    <h2 class="text-2xl font-semibold text-center mb-4">Login</h2>

    <!-- Password-based login form -->
    <div id="password-form">
        <form action="{{ route('auth.login') }}" method="POST" class="space-y-4">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full mt-1 p-2 border rounded-md" required value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full mt-1 p-2 border rounded-md" placeholder="Enter your password">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded-md mt-4">Login with Password</button>
        </form>
    </div>

    <hr class="my-6">

    <!-- OTP-based login form -->
    <div id="otp-form" class="mt-4">
        <form action="{{ route('auth.sendOtp') }}" method="POST" id="send-otp-form">
            @csrf
            <div class="mb-4">
                <label for="otp_email" class="block text-sm font-medium text-gray-700">Enter your email for OTP</label>
                <input type="email" name="email" id="otp_email" class="w-full mt-1 p-2 border rounded-md" required value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full p-2 bg-green-500 text-white rounded-md mt-4">Send OTP</button>
        </form>
    </div>

    <!-- OTP Modal -->
    <div id="otp-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800">Enter OTP</h3>
            <p class="text-sm text-gray-600 mb-4">An OTP has been sent to your email. Please enter it below:</p>

            <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="email" id="otp_email_hidden" value="{{ old('email') }}">

                <div>
                    <label for="otp" class="block text-sm font-medium text-gray-700">OTP</label>
                    <input
                        type="text"
                        name="otp"
                        id="otp"
                        class="w-full mt-1 p-2 border rounded-md"
                        placeholder="Enter OTP"
                        required
                    >
                    @error('otp')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="close-modal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Verify OTP</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const otpModal = document.getElementById('otp-modal');
    const closeModalButton = document.getElementById('close-modal');
    const otpEmailField = document.getElementById('otp_email');
    const otpHiddenField = document.getElementById('otp_email_hidden');

    // Show OTP modal if session has otp_sent
    @if (session('otp_sent'))
        otpModal.classList.remove('hidden');
        otpHiddenField.value = "{{ session('email') }}";
    @endif

    // Hide OTP modal when "Cancel" button is clicked
    closeModalButton.addEventListener('click', function () {
        otpModal.classList.add('hidden');
    });

    // Ensure email is passed to the hidden field before form submission
    document.getElementById('send-otp-form').addEventListener('submit', function () {
        const email = otpEmailField.value;
        otpHiddenField.value = email;
    });
});

</script>
@endsection
