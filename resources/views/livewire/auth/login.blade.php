<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-sm w-full px-4">
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-600 mb-1">Login & Signup Here</h1>

            </div>

            <!-- Google Sign In -->
            @livewire('auth.google-login', [
                'class' => 'w-full flex items-center justify-center gap-3 px-6 py-3 bg-white hover:bg-gray-50 border border-gray-200 rounded-lg font-medium text-gray-700 transition-all duration-200 hover:shadow-sm'
            ])
            @livewire('auth.github')
        </div>
    </div>
</div>
