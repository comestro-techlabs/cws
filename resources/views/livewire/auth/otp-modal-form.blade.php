<div>
<form wire:submit.prevent="verifyotp" method="POST" class="space-y-4">
            <input type="hidden" wire:model="email" name="email" id="otp_email_hidden" value="{{ session('email') }}">

            <div>
                <label for="otp" class="block text-gray-700 text-sm font-bold mb-2">OTP</label>
                <input type="text" wire:model="otp" name="otp" id="otp" class="w-full bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 rounded-lg py-2.5 px-4 transition duration-300" placeholder="Enter OTP" >
                @error('otp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Verify OTP</button>
        </form>
</div>
