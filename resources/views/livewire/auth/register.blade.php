<div>
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

                <form wire:submit.prevent="register" method="POST"
                    class="space-y-3  rounded-lg  p-2" autocomplete="off">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mt-2">Name</label>
                        <input type="text" value="{{ old('name') }}" wire:model="name" placeholder="name" name="name" id="name"
                            class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                        @error('name')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-1 flex-col md:flex-row gap-2">
                        <div class="flex-1">
                            <label for="email" class="block text-sm font-medium text-gray-700 mt-2">Email</label>
                            <input type="email" wire:model="email" value="{{ old('email') }}" name="email" id="email"
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
                            <input type="text" wire:model="contact" placeholder="9XXXXXXXX5" value="{{ old('contact') }}" name="contact"
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
                        <select name="gender" value="{{ old('gender') }}" wire:model="gender" id="gender"
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
                            <select name="education_qualification" id="education_qualification" wire:model="education_qualification"
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
                            <input value="{{ old('dob') }}" type="date" name="dob" id="dob" wire:model="dob"
                                class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                                max="{{ date('Y-m-d') }}">
                            @error('dob')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- google-recaptcha --}}


                    <!-- Loader (Hidden by Default) -->
                    <div id="loader"
                        class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-white"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col items-center space-y-4">
                        <button type="submit" id="submitBtn"
                            class="w-full py-2 px-4 bg-gray-700 text-white font-bold rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 flex items-center justify-center">

                            <!-- Button Text -->
                            <span class="mr-2">Create Your Account</span>

                            <!-- Spinner -->
                            <span wire:loading>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </span>
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







</div>