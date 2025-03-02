<div>
    <div class="flex gap-3 mt-10  px-[2%] flex-row justify-between items-center">

        <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-purple-800 pl-3">
            Insert Course</h2>
    </div>
    <div class="flex flex-1 flex-col px-[2%] w-full justify-center items-center">
       
    
    <form wire:submit.prevent="insertCourse" class="max-w-max	border flex flex-col rounded px-10 py-5 mt-5">
    @csrf
    <div class="mx-auto mb-5 group">
        <label for="title" class="block text-sm text-gray-500 mb-2">Course Title</label>
        <input type="text"  wire:model="title"  size="60"  placeholder="e.g Learn python with tkinter etc"
            class="block py-2.5 px-2 w-full text-sm text-gray-900 bg-transparent border border-gray-300 rounded appearance-none   focus:outline-none focus:ring-0 focus:border-blue-600" />
        @error('title')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror
    </div>
    
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center    self-end">Create Course</button>
    </form>
</div>
</div>
