<div class="min-h-screen  p-4 sm:p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Edit Profile</h1>
        </div>

        <form wire:submit.prevent="updateProfile" class="p-6">
            <div class="space-y-6">
                <!-- Email (Readonly) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    <div class="md:col-span-1">
                        <label class="block text-gray-700 font-medium">Email</label>
                        <p class="text-sm text-gray-500 mt-1">Your login email (cannot be changed)</p>
                    </div>
                    <div class="md:col-span-2">
                        <input type="email" value="{{ Auth::user()->email }}" readonly
                            class="w-full px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                    </div>
                </div>

                <!-- Name -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <div class="md:col-span-1">
                        <label for="name" class="block text-gray-700 font-medium">Full Name</label>
                    </div>
                    <div class="md:col-span-2">
                        <input type="text" id="name" wire:model.defer="name"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contact -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <div class="md:col-span-1">
                        <label for="contact" class="block text-gray-700 font-medium">Phone Number</label>
                    </div>
                    <div class="md:col-span-2">
                        <input type="tel" id="contact" wire:model.defer="contact"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('contact') border-red-500 @enderror"
                            placeholder="+1234567890">
                        @error('contact')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Education Qualification -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <div class="md:col-span-1">
                        <label for="education_qualification" class="block text-gray-700 font-medium">Education Qualification</label>
                    </div>
                    <div class="md:col-span-2">
                        <select id="education_qualification" wire:model.defer="education_qualification"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                            <option value="" disabled selected>Select your qualification</option>
                            <option value="BCA">BCA</option>
                            <option value="BBA">BBA</option>
                            <option value="MCA">MCA</option>
                            <option value="B.COM">B.COM</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div>

                <!-- Date of Birth -->
              
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
    <div class="md:col-span-1">
        <label for="dob" class="block text-gray-700 font-medium">Date of Birth</label>
        <p class="text-sm text-gray-500 mt-1">You must be at least 12 years old</p>
    </div>
    <div class="md:col-span-2">
        @php
            $minDate = now()->subYears(12)->format('Y-m-d');
            $maxDate = now()->format('Y-m-d');
        @endphp
        <input type="date" id="dob" wire:model.defer="dob" 
            max="{{ $maxDate }}"
            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('dob') border-red-500 @enderror">
        @error('dob')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

                <!-- Gender -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <div class="md:col-span-1">
                        <label class="block text-gray-700 font-medium">Gender</label>
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex flex-col space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model.defer="gender" value="male" class="form-radio h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-gray-700">Male</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model.defer="gender" value="female" class="form-radio h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-gray-700">Female</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model.defer="gender" value="other" class="form-radio h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-gray-700">Other</span>
                            </label>
                        </div>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col-reverse sm:flex-row justify-end gap-3">
                <a href="{{ route('student.dashboard') }}"
                    class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>