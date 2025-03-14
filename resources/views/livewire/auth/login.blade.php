<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full px-4">
        <div class="bg-white border rounded-lg shadow-sm p-6 h-[500px]">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-600 mb-1">Login & Signup Here</h1>

            </div>
            <hr/>
            <!-- Google Sign In -->


            <div class="flex flex-1 space-y-2 flex-col">
                @livewire('auth.google-login')
                @livewire('auth.github')
                @livewire('auth.linkedin-login')
                @livewire('auth.facebook')
            </div>
        </div>
    </div>
</div>
