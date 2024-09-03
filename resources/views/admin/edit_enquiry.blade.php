@extends('admin.base')

@section('title', 'Update Enquiry | ')

@section('content')
    <div class="flex flex-1">
        <form action="{{ route('admin.enquiry.update',$enquiry->id) }}" class="max-w-md mx-auto border border-orange-500 rounded px-10 py-5 mt-5" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="flex flex-1 mb-2">
                <h2 class="text-orange-600 text-2xl py-2 text-center font-semibold">Edit Enquiry Details</h2>
            </div>

            <!-- Full Name -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="name" id="name" value="{{ $enquiry->name }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " readonly />
                @error('name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full Name</label>
            </div>

            <!-- Contact -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="mobile" id="contact" value="{{ $enquiry->mobile }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " readonly/>
                @error('mobile')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <label for="contact"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"  >Contact</label>
            </div>

            <!-- Email -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="email" value="{{ $enquiry->email }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " readonly />
                @error('email')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6" >Email</label>
            </div>

            <!-- Education Qualification -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="" id="education_qualification" value="{{ $enquiry->message }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " readonly />
                @error('message')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <label for="education_qualification"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"  >Message</label>
            </div>

            <!-- Gender -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="status" id="gender" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <option value="" {{ $enquiry->status == '0' ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ $enquiry->status == '1' ? 'selected' : '' }}>Approved</option>
                    <option value="2" {{ $enquiry->status == '2' ? 'selected' : '' }}>Close</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <label for="gender"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label>
            </div>

             <!-- Submit Button -->
             <button type="submit"
             class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Course</button>
     </form>
 
 </div>
 @endsection