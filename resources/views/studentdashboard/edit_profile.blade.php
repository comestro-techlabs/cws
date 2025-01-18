@extends('studentdashboard.include.base')
@section('content')

<div class="mt-16 p-6 bg-gray-50 dark:bg-gray-900">
  <!-- Page Heading -->
  <div class="border-b border-gray-300 dark:border-gray-700 pb-4 mb-6">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Account</h1>
    </div>
  </div>

  <!-- Success Message -->
  @if(session('success'))
  <div class="container mx-auto mb-6">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  </div>
  @endif

  <!-- Form -->
  <form action="{{ route('student.updateProfile') }}" method="POST" class="container mx-auto">
    @csrf
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
      <div class="flex flex-col md:flex-row">
        <!-- Sidebar Info -->
        <div class="w-full md:w-1/3 bg-gray-100 dark:bg-gray-700 p-6">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">Basic Information</h2>
          <p class="text-sm text-gray-600 dark:text-gray-300">Edit your account details and settings.</p>
        </div>

        <!-- Form Fields -->
        <div class="w-full md:w-2/3 p-6 space-y-6">
          <!-- Email (Read-Only) -->
          <div>
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Email</label>
            <div class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-4 py-3 rounded-lg">
              {{ Auth::user()->email }}
            </div>
          </div>

          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Contact -->
          <div>
            <label for="contact" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Contact</label>
            <input type="text" id="contact" name="contact" value="{{ old('contact', Auth::user()->contact) }}" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
          </div>

          <!-- Education Qualification -->
          <div>
            <label for="education_qualification" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Education Qualification</label>
            <input type="text" id="education_qualification" name="education_qualification" value="{{ old('education_qualification', Auth::user()->education_qualification) }}" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
          </div>

          <!-- Date of Birth -->
          <div>
            <label for="dob" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Date of Birth</label>
            <input type="date" id="dob" name="dob" value="{{ old('dob', Auth::user()->dob) }}" max="{{ date('Y-m-d') }}" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
          </div>

          <!-- Gender -->
          <div>
            <label for="gender" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Gender</label>
            <select id="gender" name="gender" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
              <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
              <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
              <option value="other" {{ Auth::user()->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
            <input type="password" id="password" name="password" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full mt-2 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring focus:ring-blue-300">
            @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end mt-6 space-x-4">
      <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg">Update Profile</button>
      <a href="{{ route('student.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg">Cancel</a>
    </div>
  </form>
</div>

@endsection
