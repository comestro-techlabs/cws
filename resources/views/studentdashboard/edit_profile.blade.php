@extends('studentdashboard.include.base')
@section('content')

    <div class="mt-16 p-6 bg-white">
        <!-- Page Heading -->
        <div class="border-b border-gray-100 pb-4 mb-6">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Edit Account</h1>
            </div>
        </div>

        <!-- Success or Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('student.updateProfile') }}" method="POST" class="container mx-auto">
            @csrf
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <!-- Sidebar Info -->
                    <div class="w-full md:w-1/3 bg-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Basic Information</h2>
                        <p class="text-sm text-gray-600">Edit your account details and settings.</p>
                    </div>

                    <!-- Form Fields -->
                    <div class="w-full md:w-2/3 p-6 space-y-6">
                        <!-- Email (Read-Only) -->
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" readonly
                                class="block w-full px-4 py-2 bg-gray-200 border rounded-lg border-slate-200">
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}"
                                class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contact -->

                        <div>
                            <label for="contact" class="block text-sm font-semibold text-gray-700">Contact</label>
                            <input type="text" id="contact" name="contact"
                                value="{{ old('contact', Auth::user()->contact) }}"
                                class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                        </div>

                        <!-- Education Qualification -->
                        <div class="">
                            <label for="education_qualification" class="block text-sm font-semibold text-gray-700">Education
                                Qualification</label>
                            <select name="education_qualification" id="education_qualification"
                                class="mt-1 block px-3 py-2 w-full  border border-slate-200 rounded-md focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
                                <option value="" disabled
                                    {{ old('education_qualification', Auth::user()->education_qualification) ? '' : 'selected' }}>
                                    Select your qualification</option>
                                <option value="BCA"
                                    {{ Auth::user()->education_qualification == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="BBA"
                                    {{ Auth::user()->education_qualification == 'BBA' ? 'selected' : '' }}>BBA</option>
                                <option value="MCA"
                                    {{ Auth::user()->education_qualification == 'MCA' ? 'selected' : '' }}>MCA</option>
                                <option value="B.COM"
                                    {{ Auth::user()->education_qualification == 'B.COM' ? 'selected' : '' }}>B.COM</option>
                                <option value="Others"
                                    {{ Auth::user()->education_qualification == 'Others' ? 'selected' : '' }}>Others
                                </option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="dob" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob', Auth::user()->dob) }}"
                                max="{{ date('Y-m-d') }}"
                                class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-semibold text-gray-700">Gender</label>
                            <select id="gender" name="gender"
                                class="block w-full mt-2 px-4 py-2 border rounded-lg border-slate-200 focus:ring focus:ring-blue-300">
                                <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ Auth::user()->gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="flex justify-end mt-6 space-x-4">
                <button type="submit"
                    class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-lg hover:cursor-pointer">Update
                    Profile</button>
                <a href="{{ route('student.dashboard') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">Cancel</a>
            </div>
        </form>
    </div>

@endsection
