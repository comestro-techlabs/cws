<div class="mt-16 p-6 bg-white">
    <div class="border-b border-gray-100 pb-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Account</h1>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="container mx-auto">
        @csrf
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/3 bg-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Basic Information</h2>
                    <p class="text-sm text-gray-600">Edit your account details and settings.</p>
                </div>

                <div class="w-full md:w-2/3 p-6 space-y-6">
                    <!-- Email (Read-Only) -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" value="{{ Auth::user()->email }}" readonly
                            class="block w-full px-4 py-2 bg-gray-200 border rounded-lg border-slate-200">
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Name</label>
                        <input type="text" wire:model.defer="name"
                            class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contact -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Contact</label>
                        <input type="text" wire:model.defer="contact"
                            class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Education Qualification -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Education Qualification</label>
                        <select wire:model.defer="education_qualification"
                            class="mt-1 block px-3 py-2 w-full border border-slate-200 rounded-md focus:ring focus:ring-gray-200">
                            <option value="" disabled>Select your qualification</option>
                            <option value="BCA">BCA</option>
                            <option value="BBA">BBA</option>
                            <option value="MCA">MCA</option>
                            <option value="B.COM">B.COM</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                        <input type="date" wire:model.defer="dob" max="{{ date('Y-m-d') }}"
                            class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Gender</label>
                        <select wire:model.defer="gender"
                            class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end mt-6 space-x-4">
            <button type="submit"
                class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-lg hover:cursor-pointer">
                Update Profile
            </button>
            <a href="{{ route('student.dashboard') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">Cancel</a>
        </div>
    </form>
</div>
