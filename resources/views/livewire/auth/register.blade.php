<div>
    <form wire:submit.prevent="register" class="space-y-3  rounded-lg  p-2">
        <input type="text" wire:model="name" placeholder="Name" class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="email" wire:model="email" placeholder="Email" class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="text" wire:model="contact" placeholder="Contact" class="form-input  block w-full rounded-md border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50">
        @error('contact') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        <div>
        <label for="gender" class="block text-sm font-medium text-gray-700 mt-2">Gender</label>
        <select wire:model="gender">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        </div>
        @error('gender') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        
        <div class="flex md:flex-1 flex-col md:flex-row gap-2">
        <div class="flex-1">
        <label for="education_qualification"
        class="block text-sm font-medium text-gray-700 mt-2">Education Qualification</label>        
        <select wire:model="education_qualification">
            <option value="">Select Qualification</option>
            <option value="BCA">BCA</option>
            <option value="BBA">BBA</option>
            <option value="MCA">MCA</option>
            <option value="B.COM">B.COM</option>
            <option value="Others">Others</option>
        </select>
        @error('education_qualification') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        </div>
        <div>
        <label for="dob" class="block text-sm font-medium text-gray-700 mt-2">Date of Birth</label>
        <input type="date" wire:model="dob">
        @error('dob') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        
     

        <!-- <button type="submit">Register</button> -->
        <div class="flex flex-col items-center space-y-4">
                <button type="submit" 
                    class="w-full py-2 px-4 bg-gray-700 text-white font-bold rounded-md hover:bg-gray-600 focus:outline-nonfocus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                    Create Your Account
                </button>
                <span class="text-gray-600 text-sm">
                            Already have an account?
                            <a href="{{ route('auth.login') }}" class="text-secondary">Login here</a>
                </span>
        </div>
    </form>

   
</div>

