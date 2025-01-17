@extends('public.layout')

@section('title')
Sign up
@endsection

@section('content')

<div class="font-[sans-serif] bg-white max-w-4xl flex w-full h-screen items-center mx-auto md:h-screen p-4">
    <div class="grid md:grid-cols-3 items-center shadow-xl border rounded-xl overflow-hidden">
        <div class="max-md:order-1 hidden md:block flex-col justify-center space-y-16 max-md:mt-16 min-h-full bg-gradient-to-r from-gray-900 to-gray-700 lg:px-8 px-4 py-4">
            <div class="mt-24">
                <h4 class="text-white text-lg font-semibold">Create Your Account</h4>
                <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">Welcome to <span class="text-orange-500 font-bold">Learn</span><span class="text-blue-600 font-bold">syntax</span> Get started by creating your account.</p>
            </div>
            <div>
                <h4 class="text-white text-lg font-semibold">Affordable | Quality</h4>
                <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">At our coaching center, we provide top-notch education and training to help you excel in your career. Start your journey with us today and unlock endless opportunities!</p>
            </div>
        </div>

        <div class="md:col-span-2 w-full py-6 px-6 sm:px-16">
            <div class="mb-6">
                <h3 class="text-gray-800 text-2xl font-bold">Create an account</h3>
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
            <form id="applyForm" action="{{ route('auth.register.post') }}" method="POST" class="space-y-3 rounded-lg p-2" autocomplete="off">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" id="name"
                        class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                    @error('name')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="flex flex-1 gap-2">
                    <div class="flex-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        @error('email')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div class="flex-1">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input type="text" value="{{ old('contact') }}" name="contact" id="contact"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        @error('contact')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" value="{{ old('gender') }}" id="gender"
                        class="mt-1 block px-3 py-2 w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Education Qualification -->
                <div class="flex flex-1 gap-2">
                    <div class="flex-1">
                        <label for="education_qualification" class="block text-sm font-medium text-gray-700">Education Qualification</label>
                        <select name="education_qualification" id="education_qualification"
                            class="mt-1 block px-3 py-2 w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                            <option value="" disabled {{ old('education_qualification') ? '' : 'selected' }}>Select your qualification</option>
                            <option value="BCA" {{ old('education_qualification') == 'BCA' ? 'selected' : '' }}>BCA</option>
                            <option value="BBA" {{ old('education_qualification') == 'BBA' ? 'selected' : '' }}>BBA</option>
                            <option value="MCA" {{ old('education_qualification') == 'MCA' ? 'selected' : '' }}>MCA</option>
                            <option value="B.COM" {{ old('education_qualification') == 'B.COM' ? 'selected' : '' }}>B.COM</option>
                            <option value="Others" {{ old('education_qualification') == 'others' ? 'selected' : '' }}>Others</option>
                        </select>
                        @error('education_qualification')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="flex-1">
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input value="{{ old('dob') }}" type="date" name="dob" id="dob"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50" max="{{ date('Y-m-d') }}">
                        @error('dob')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Terms and Conditions -->
                {{-- <div class="flex items-center">
                    <input type="checkbox" name="terms" id="terms"
                        class="mr-2 h-4 w-4 text-gray-700 border-gray-300 rounded focus:bg-gray-teal-500" required>
                    <label for="terms" class="text-sm text-gray-700">I agree to the terms and conditions</label>
                </div> --}}

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-2 px-4 bg-gray-700 text-white font-bold rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Create Your Account</button>
            </form>
        </div>
    </div>
</div>
       <!-- Modal -->
<div id="otpModal" class="{{ session('showModal') || $errors->has('otp') ? '' : 'hidden' }} fixed z-10 bg-gray-900 bg-opacity-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen w-full">
        <div class="bg-white rounded-lg shadow-xl p-6 w-96">
            <form method="POST" action="{{ route('auth.verifyOtp.register') }}">
                @csrf

                <h3 class="text-lg font-bold mb-4">Verify OTP</h3>

                <!-- Email Field (Read-Only) -->
                <div class="mb-4">
                    {{-- <label for="email" class="block text-sm font-medium text-gray-700">Email</label> --}}
                    <input type="hidden" name="email" id="otp_email_hidden" value="{{ session('email') }}">

                </div>

                <!-- OTP Field -->
                <div class="mb-4">
                    <label for="otp" class="block text-sm font-medium text-gray-700">OTP</label>
                    <input type="text" id="otp" name="otp" value="{{ old('otp') }}" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @error('otp') 
                        <span class="text-red-500 text-xs">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Verify OTP
                </button>
                <button type="button" id="close-modal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancel</button>

            </form>
        </div>
    </div>
</div>

<script>
    // Ensure the modal remains open if there are validation errors
    @if($errors->has('otp'))
        document.getElementById('otpModal').classList.remove('hidden');
    @endif
</script>
{{-- <script>
    // Show modal if session contains 'showModal'
    @if(session('showModal'))
        document.getElementById('otpModal').classList.remove('hidden');
    @endif
</script> --}}
@endsection
