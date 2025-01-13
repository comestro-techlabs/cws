@extends('public.layout')


@section('title')
Sign up
@endsection
@section('content')

<div class="font-[sans-serif]  bg-white max-w-4xl flex w-full h-screen items-center mx-auto md:h-screen p-4">
    <div class=" grid md:grid-cols-3 items-center shadow-xl border rounded-xl  overflow-hidden">
        <div class="max-md:order-1  hidden md:block flex flex-col justify-center space-y-16 max-md:mt-16 min-h-full bg-gradient-to-r from-gray-900 to-gray-700 lg:px-8 px-4 py-4">
            <div class="mt-24">
                <h4 class="text-white text-lg font-semibold">Create Your Account</h4>
                <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">Welcome to <span class="text-orange-500 font-bold">Com</span><span
                        class="text-blue-600 font-bold">estro</span> Get started by creating your account.</p>
            </div>
            <div>
                <h4 class="text-white text-lg font-semibold">Afforable | Quality</h4>
                <p class="text-[13px] text-gray-300 mt-3 leading-relaxed"> At our coaching center, we provide top-notch education and training to help you excel in your career.
                    Start your journey with us today and unlock endless opportunities!</p>
            </div>
        </div>

        <div class="md:col-span-2 w-full py-6 px-6 sm:px-16">
            <div class="mb-6">
                <h3 class="text-gray-800 text-2xl font-bold">Create an account</h3>
            </div>

            <form id="applyForm" action="{{ route('auth.register.post') }}" method="POST"
                class="space-y-3  rounded-lg  p-2" autocomplete="off">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                        class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                    @error('name')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="flex flex-1 gap-2">
                    <div class="flex-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        @error('email')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <span id="emailError" class="text-red-600 text-sm hidden">Please enter a valid email address.</span>
                    </div>

                    <!-- Contact -->
                    <div class="flex-1">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input type="text" name="contact" id="contact"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        @error('contact')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <span id="contactError" class="text-red-600 text-sm hidden">Please enter a valid contact
                            number.</span>
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender"
                        class="mt-1 block px-3 py-2 w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Education Qualification -->
                <div class="flex flex-1 gap-2">
                    <div class="flex-1">
                        <label for="education_qualification" class="block text-sm font-medium text-gray-700">
                            Education Qualification
                        </label>
                        <select name="education_qualification" id="education_qualification"
                            class="mt-1 block px-3 py-2 w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                            <option value="" disabled selected>Select your qualification</option>
                            <option value="High School">BCA</option>
                            <option value="Bachelor's Degree">MCA</option>
                            <option value="Master's Degree">BCOM</option>
                            <option value="PhD">BSC</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('education_qualification')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Date of Birth -->
                    <div class="flex-1">
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="dob" id="dob"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50" max="{{ date('Y-m-d') }}">
                        @error('dob')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                   
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50" required>
                   
                    @error('password')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                     @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center">
                    <input type="checkbox" name="terms" id="terms"
                        class="mr-2 h-4 w-4 text-gray-700 border-gray-300 rounded focus:bg-gray-teal-500">
                    <label for="terms" class="text-sm text-gray-700">I agree to the terms and conditions</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-2 px-4 bg-gray-700 text-white font-bold rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Create Your Account</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('applyForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const contact = document.getElementById('contact').value.trim();
        const gender = document.getElementById('gender').value.trim();
        const educationQualification = document.getElementById('education_qualification').value.trim();
        const dob = document.getElementById('dob').value.trim();
        const password = document.getElementById('password').value.trim();
        const terms = document.getElementById('terms').checked;

        let valid = true;

        // Email validation
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            valid = false;
            document.getElementById('emailError').classList.remove('hidden');
        } else {
            document.getElementById('emailError').classList.add('hidden');
        }

        // Contact validation
        const contactPattern = /^\d{10}$/;
        if (!contactPattern.test(contact)) {
            valid = false;
            document.getElementById('contactError').classList.remove('hidden');
        } else {
            document.getElementById('contactError').classList.add('hidden');
        }

        if (valid) {
            // If all validations pass, submit the form
            this.submit();
        } else {

        }
    });
</script>
@endsection