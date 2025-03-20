<div class="min-h-screen pt-10 flex items-center justify-center bg-gradient-to-br from-purple-50 via-white to-purple-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full">
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-sm border border-gray-100">
            <div class="grid md:grid-cols-2 gap-0">
                <!-- Left Column - Registration Form -->
                <div class="p-8 border-r border-gray-100">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                        <p class="text-gray-600">Join our learning community today</p>
                    </div>
 
                    <form wire:submit.prevent="register" class="space-y-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" 
                                   wire:model="name" 
                                   id="name"
                                   class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Enter your full name">
                            @error('name') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <input type="email" 
                                   wire:model="email" 
                                   id="email"
                                   class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Enter your email">
                            @error('email') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" 
                                   wire:model="contact" 
                                   id="contact"
                                   class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Enter your contact number">
                            @error('contact') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <div class="relative">
                                    <input type="password" 
                                           wire:model="password" 
                                           id="password"
                                           class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Create password">
                                </div>
                                @error('password') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" 
                                       wire:model="password_confirmation" 
                                       id="password_confirmation"
                                       class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       placeholder="Confirm password">
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                            Create Account
                        </button>
                    </form>
                </div>

                <!-- Right Column - Social Registration -->
                <div class="p-8 bg-gradient-to-br from-purple-50 to-white rounded-r-2xl">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Quick Registration</h2>
                        <p class="text-gray-600">Sign up with your social accounts</p>
                    </div>

                    <div class="space-y-4">
                        @livewire('auth.google-login')
                        @livewire('auth.github')
                        @livewire('auth.linkedin-login')
                        @livewire('auth.facebook')
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('auth.login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
