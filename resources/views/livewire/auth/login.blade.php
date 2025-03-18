<div class="min-h-screen pt-10 flex items-center justify-center bg-gradient-to-br from-purple-50 via-white to-purple-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full">
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-sm border border-gray-100">
            <div class="grid md:grid-cols-2 gap-0">
                <!-- Left Column - Email/Password Form -->
                <div class="p-8 border-r border-gray-100">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                        <p class="text-gray-600">Sign in with your credentials</p>
                    </div>

                    <form wire:submit.prevent="login" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <input type="email" 
                                   wire:model="email" 
                                   id="email"
                                   class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                   placeholder="Enter your email">
                            @error('email') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <input type="password" 
                                       wire:model="password" 
                                       id="password"
                                       class="appearance-none block w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       placeholder="Enter your password">
                                <button type="button" 
                                        onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="h-5 w-5 text-gray-400" id="eye-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-sm text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       wire:model="remember"
                                       id="remember"
                                       class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>
                            <a href="#" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                            Sign in
                        </button>
                    </form>
                </div>

                <!-- Right Column - Social Login -->
                <div class="p-8 bg-gradient-to-br from-purple-50 to-white rounded-r-2xl">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Quick Access</h2>
                        <p class="text-gray-600">Sign in with your social accounts</p>
                    </div>

                    <div class="space-y-4">
                        @livewire('auth.google-login')
                        @livewire('auth.github')
                        @livewire('auth.linkedin-login')
                        @livewire('auth.facebook')
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{route('auth.register')}}" class="font-medium text-purple-600 hover:text-purple-500">
                                Sign up for free
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                password.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</div>
