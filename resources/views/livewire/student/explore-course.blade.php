<div>

   <div class="w-full flex-col md:flex-row border-b pb-3 flex justify-between md:items-center px-4 rounded-lg mt-5">
       <h1 class="text-lg font-medium">Explore Courses</h1>

    
       <div class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm">
           <input type="text" placeholder="Search for courses..." wire:model.live="search"
               class="w-full px-4 py-2 text-gray-800 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-l-lg">
           <button type="button" class="p-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition-colors">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="size-6">
                   <path stroke-linecap="round" stroke-linejoin="round"
                       d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
               </svg>
           </button>
       </div>
   </div>


   <div class="container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
       @foreach ($courses as $course)
           <div
               class="bg-white flex-1 border border-gray-200 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
              
               <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="Course Image"
                   class="w-full h-48 object-cover">
             
               <div class="p-5 space-y-4">
                   <h2 class="text-xl font-semibold text-gray-900 truncate">
                       <a href="#">{{ $course->title }}</a>
                   </h2>
                   <p class="text-sm text-gray-600">Instructor: <span
                           class="text-blue-500 font-medium">{{ $course->instructor }}</span></p>
                   <div class="flex justify-between items-center">
                       <span class="text-lg font-semibold text-gray-900">₹ {{ $course->discounted_fees }}</span>

                       @if (auth()->user() && auth()->user()->is_member)
                           <button wire:click="enroll({{ $course->id }})"
                               class="bg-purple-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-purple-700 transition-colors">
                               Enroll now
                           </button>
                       @else
                           <a href="{{ route('student.viewCourses', ['courseId' => $course->id]) }}"
                               class="bg-blue-600 text-white font-medium rounded-lg px-4 py-2 hover:bg-blue-700 transition-colors">
                               <div class="flex gap-2">
                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                       stroke-width="1.5" stroke="currentColor" class="size-6">
                                       <path stroke-linecap="round" stroke-linejoin="round"
                                           d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                   </svg>
                                   <span>Enroll Now</span>
                               </div>
                           </a>
                       @endif
                   </div>
               </div>
           </div>
       @endforeach
   </div>

  
   <div class="container mx-auto mt-8 flex flex-col md:flex-row items-center justify-between space-y-4">
       {{ $courses->links() }}
   </div>
</div>
