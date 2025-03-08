<div class="min-h-[200px] flex flex-col">
    <form wire:submit.prevent="verifyotp" method="POST" class="space-y-6 flex-grow">
        <input type="hidden" wire:model="email" name="email" id="otp_email_hidden" value="{{ session('email') }}">

        <div>
            <label for="otp" class="block text-gray-700 text-sm font-semibold mb-2">Verification Code</label>
            <div class="relative">
                <input type="text" wire:model="otp" name="otp" id="otp" 
                    class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 border border-gray-200 rounded-lg py-3 px-4 pl-10 transition duration-200" 
                    placeholder="Enter 6-digit code">
                <span class="absolute left-3 top-3.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </span>
            </div>
            @error('otp') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <button type="submit" class="w-full bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 flex items-center justify-center gap-2">
            <span>Verify Code</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </form>
</div>
