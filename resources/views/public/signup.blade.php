<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CWS || Signup </title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen background-image">
    <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md bg-opacity-80">
        <h2 class="text-2xl font-bold mb-6 text-center text-teal-600">Signup for CWS</h2>
        <form action="{{ route('public.register') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-teal-600">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    @error('name')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-teal-600">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    @error('email')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="contact" class="block text-sm font-medium text-teal-600">Contact Number</label>
                    <input type="tel" id="contact" name="contact" value="{{ old('contact') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    @error('contact')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="dob" class="block text-sm font-medium text-teal-600">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="{{ old('dob') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    @error('dob')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-teal-600">Gender</label>
                    <select id="gender" name="gender" value="{{ old('gender') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        <option value="" disabled selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="course" class="block text-sm font-medium text-teal-600">Course Interest</label>
                    <select id="course" name="course" value="{{ old('course') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        <option value="" disabled selected>Select a course</option>
                        <option value="math">Php webDev</option>
                        <option value="science">Nexts</option>
                        <option value="english">React.Dev</option>
                        <option value="computer">Laravel</option>
                    </select>
                    @error('course')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-teal-600">Password</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    @error('password')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="confirm-password" class="block text-sm font-medium text-teal-600">Confirm
                        Password</label>
                    <input type="password" id="confirm-password" name="confirm-password"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    @error('confirm-password')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="referral" class="block text-sm font-medium text-teal-600">Referral Source</label>
                    <input type="text" id="referral" name="referral" value="{{ old('referral') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="education" class="block text-sm font-medium text-teal-600">Education
                        Qualification</label>
                    <input type="text" id="education" name="education" value="{{ old('education') }}"
                        class="mt-1 block w-full px-4 py-2 border border-teal-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                </div>
            </div>
            <div class="mt-6 flex items-center justify-center">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Sign
                    Up</button>
            </div>
        </form>
    </div>
</body>

</html>
