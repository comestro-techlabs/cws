@extends('public.layout')


@section('title')
    Sign up
@endsection
@section('content')
    <div
        class="font-[sans-serif] md:max-w-5xl md:mt-8 mt-4 bg-white  flex w-full h-screen items-center mx-auto md:h-screen p-4">
        <div class=" grid w-full md:grid-cols-3 grid-cols-1 items-center shadow-xl border rounded-xl  overflow-hidden">
            <div
                class="max-md:order-1 hidden md:block flex-col justify-center space-y-16 max-md:6 min-h-full bg-gradient-to-r from-gray-800 to-gray-600 lg:px-8 px-4 py-4">
                <div class="mt-24">
                    <h4 class="text-white text-lg font-semibold">Create Your Account</h4>
                    <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">
                        Register now and access:
                    </p>
                    <ul class="text-[13px] text-gray-300 mt-2 leading-relaxed list-disc pl-5">
                        <li>Assignments & Exams</li>
                        <li>Payment Management</li>
                        <li>Certificates</li>
                        <li>All Programming Courses</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold">Why Choose Us?</h4>
                    <ul class="text-[13px] text-gray-300 mt-2 leading-relaxed list-disc pl-5">
                        <li>Affordable ₹700/month</li>
                        <li>Quality Training</li>
                        <li>Learn Any Programming Language</li>
                        <li>Career-Oriented Courses</li>
                    </ul>
                </div>
            </div>


            <div class="md:col-span-2 w-full py-6 px-6 sm:px-16">
                <div class="my-3">
                    <h3 class="text-gray-800 text-2xl font-bold">Create an account</h3>
                </div>

                <form id="applyForm" action="{{ route('auth.register.post') }}" method="POST"
                    class="space-y-3  rounded-lg  p-2" autocomplete="off">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mt-2">Name</label>
                        <input type="text" value="{{ old('name') }}" placeholder="name" name="name" id="name"
                            class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        @error('name')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-1 flex-col md:flex-row gap-2">
                        <div class="flex-1">
                            <label for="email" class="block text-sm font-medium text-gray-700 mt-2">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email"
                                placeholder="abc@gmail.com"
                                class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                            @error('email')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <span id="emailError" class="text-red-600 text-sm hidden">Please enter a valid email
                                address.</span>
                        </div>

                        <!-- Contact -->
                        <div class="flex-1">
                            <label for="contact" class="block text-sm font-medium text-gray-700 mt-2">Contact</label>
                            <input type="text" placeholder="9XXXXXXXX5" value="{{ old('contact') }}" name="contact"
                                id="contact"
                                class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                            @error('contact')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <span id="contactError" class="text-red-600 text-sm hidden">Please enter a valid contact
                                number.</span>
                        </div>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mt-2">Gender</label>
                        <select name="gender" value="{{ old('gender') }}" id="gender"
                            class=" block px-3 py-2 w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
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
                    <div class="flex md:flex-1 flex-col md:flex-row gap-2">
                        <div class="flex-1">
                            <label for="education_qualification"
                                class="block text-sm font-medium text-gray-700 mt-2">Education Qualification</label>
                            <select name="education_qualification" id="education_qualification"
                                class=" block px-3 py-2 w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                                <option value="" disabled {{ old('education_qualification') ? '' : 'selected' }}>
                                    Select your qualification</option>
                                <option value="BCA" {{ old('education_qualification') == 'BCA' ? 'selected' : '' }}>BCA
                                </option>
                                <option value="BBA" {{ old('education_qualification') == 'BBA' ? 'selected' : '' }}>BBA
                                </option>
                                <option value="MCA" {{ old('education_qualification') == 'MCA' ? 'selected' : '' }}>MCA
                                </option>
                                <option value="B.COM" {{ old('education_qualification') == 'B.COM' ? 'selected' : '' }}>
                                    B.COM</option>
                                <option value="Others" {{ old('education_qualification') == 'others' ? 'selected' : '' }}>
                                    Others</option>
                            </select>
                            @error('education_qualification')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Date of Birth -->
                        <div class="flex-1">
                            <label for="dob" class="block text-sm font-medium text-gray-700 mt-2">Date of Birth</label>
                            <input value="{{ old('dob') }}" type="date" name="dob" id="dob"
                                class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                                max="{{ date('Y-m-d') }}">
                            @error('dob')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- google-recaptcha --}}

                    <div class="g-recaptcha mt-8 "
                        data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    @error('g-recaptcha-response')
                        <p class="text-xs text-red-500 text-center mt-2">{{ $message }}</p>
                    @enderror
                    <!-- Loader (Hidden by Default) -->
                    <div id="loader"
                        class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-white"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" id="submitBtn"
                            class="w-full py-2 px-4 bg-gray-700 text-white font-bold rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                            Create Your Account
                        </button>
                        <span class="text-gray-600 text-sm">
                            Already have an account?
                            <a href="{{ route('auth.login') }}" class="text-secondary">Login here</a>
                        </span>
                    </div>

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
                // Show loader
                document.getElementById('loader').classList.remove('hidden');
                document.getElementById('submitBtn').disabled = true;
                document.getElementById('submitBtn').innerText = "Processing...";

                setTimeout(() => {
                    this.submit(); // Submit the form after delay
                }, 500);
            }
        });
    </script>
@endsection
