<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-sm w-full px-4">
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-600 mb-1">Login & Signup Here</h1>

            </div>

            <!-- Google Sign In -->
            <div class="flex flex-1 space-y-2 flex-col">
                @livewire('auth.google-login')
                @livewire('auth.github')
            </div>
        </div>
    </div>
</div>
