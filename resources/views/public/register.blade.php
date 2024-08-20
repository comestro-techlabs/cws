@extends('public.layout')

@section('content')
<div class="flex flex-wrap">
    <!-- First Section: Motivation and Coaching Ads -->
    <div class="w-full lg:w-1/2 bg-gradient-to-r from-blue-500 to-purple-500 p-8 text-white">
        <div class="flex flex-col p-5 justify-center h-full">
            <h2 class="text-3xl font-bold mb-4">Join Us and Achieve Your Goals!</h2>
            <p class="text-lg mb-6">
                At our coaching center, we provide top-notch education and training to help you excel in your career.
                Start your journey with us today and unlock endless opportunities!
            </p>
            <div class="flex items-center gap-4">
                {{-- <img src="path_to_ad_image.jpg" alt="Coaching Ad" class="rounded-lg shadow-lg w-1/3"> --}}
                <p class="text-sm italic">"Success is not final, failure is not fatal: It is the courage to continue that counts."</p>
            </div>
        </div>
    </div>

    <!-- Second Section: Form -->
    <div class="w-full lg:w-1/2 bg-white p-8 shadow-2xl">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Apply Now</h2>
        <form id="applyForm" action="" method="POST" class="space-y-3 bg-slate-50 rounded-lg border p-4" autocomplete="off">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
            </div>
            
            <!-- Email -->
            <div class="flex flex-1 gap-2">
                <div class="flex-1">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                    <span id="emailError" class="text-red-600 text-sm hidden">Please enter a valid email address.</span>
                </div>
                
                <!-- Contact -->
                <div class="flex-1">
                    <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                    <span id="contactError" class="text-red-600 text-sm hidden">Please enter a valid contact number.</span>
                </div>
            </div>
            
            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block px-3 py-2 w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <!-- Education Qualification -->
            <div class="flex flex-1 gap-2">
                <div class="flex-1">
                    <label for="education_qualification" class="block text-sm font-medium text-gray-700">Education Qualification</label>
                    <input type="text" name="education_qualification" id="education_qualification" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                </div>
                
                <!-- Date of Birth -->
                <div class="flex-1">
                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
                </div>
            </div>
            
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 focus:ring-opacity-50">
            </div>
            
            <!-- Terms and Conditions -->
            <div class="flex items-center">
                <input type="checkbox" name="terms" id="terms" class="mr-2 h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                <label for="terms" class="text-sm text-gray-700">I agree to the terms and conditions</label>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="w-full py-2 px-4 bg-teal-600 text-white font-bold rounded-md hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-opacity-50">Submit</button>
        </form>
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
            alert('Please correct the highlighted errors before submitting the form.');
        }
    });
</script>

@endsection
