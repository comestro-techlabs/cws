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

        <form id="resend-otp-form" action="{{ route('auth.resend-otp') }}" method="POST">
            @csrf
            <p class="text-sm text-gray-600 mt-4 text-center">
                Didn't receive the OTP? <button type="submit" class="text-blue-500 font-semibold hover:text-blue-700">Resend OTP</button>
            </p>
        </form>
    </div>
</div>

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
