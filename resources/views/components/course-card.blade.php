  <div
   {{-- data-popover-target="popover-course-details{{$course->id}}" data-popover-placement="right" --}}
     class="flex border border-slate-300 rounded-t-xl rounded-b-xl w-full max-w-xs flex-col bg-white text-gray-700">
    <a href="{{route('public.courseDetails',['category_slug' => $course->category->cat_slug, 'slug' =>  $course->slug])}}" class="flex flex-1 flex-col">
      <div class="overflow-hidden bg-blue-gray-500 shadow-lg">
      <img src="storage/course_images/{{$course->course_image}}" alt="{{$course->title}}" class="w-full rounded-t-xl object-cover h-auto" />
    </div>
    <div class="p-3">
      <div class="flex items-center justify-between">
        <h5 class="text-lg capitalize font-bold text-black truncate">
          {{$course->title}}
        </h5>
      </div>
      <p class="text-xs capitalize text-gray-700 leading-relaxed mb-2">
        {{$course->category->cat_title}}
      </p>
      <div class="">
        <span class="text-green-900 font-medium text-sm">Batch Start: {{ \Carbon\Carbon::parse($course->batches[0]->start_date)->format('F j, Y') }}</span>
      </div>
      <div class="flex flex-1 justify-center mt-2">
        <a href="{{route('public.courseDetails',['category_slug' => $course->category->cat_slug, 'slug' =>  $course->slug])}}" class="w-full py-3.5 px-7 text-center bg-gray-900 text-white rounded-lg text-sm font-bold uppercase shadow-md hover:shadow-lg transition-all">
          Enroll Now
        </a>
      </div>
    </div>
    </a>
    <div data-popover id="popover-course-details{{$course->id}}" role="tooltip" class="absolute z-[999] invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-slate-300 shadow-xl rounded-lg opacity-0 w-80   ">
      <div class="p-3">
        <div class="flex">
          <div>
            <p class="mb-1 text-base font-semibold leading-none text-gray-900 ">
              <a href="#" class="hover:underline text-lg uppercase text-teal-800 font-bold">{{$course->title}}</a>
            </p>
            <p class="mb-3 text-sm font-normal capitalize">
              By: {{$course->instructor}}
            </p>
            <p class="text-base text-gray-700 leading-relaxed mb-4 line-clamp-3">
              {{$course->description}}
            </p>
            <div class="mb-4">
              <p class="text-base font-medium text-gray-700">Duration:</p>
              <p class="text-sm text-gray-600">{{$course->duration}} Weeks</p>
            </div>
            <div class="mb-4 flex-1">
              <ul class="list-none list-inside text-sm space-y-2 text-gray-600">
                @foreach($course->features as $feature)
                <li class="flex items-center">
                  <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M10 15.172l-3.707-3.707a1 1 0 00-1.414 1.414l4.414 4.414a1 1 0 001.414 0l8.414-8.414a1 1 0 10-1.414-1.414L10 15.172z"></path>
                  </svg>
                  {{$feature->name}}
                </li>
                @endforeach
              </ul>
            </div>

            <!-- Batch Information -->


            <div class="flex flex-1 justify-center">
              <a href="{{route('public.courseDetails',['category_slug' => $course->category->cat_slug, 'slug' =>  $course->slug])}}" class="w-full py-3.5 px-7 text-center bg-gray-900 text-white rounded-lg text-sm font-bold uppercase shadow-md hover:shadow-lg transition-all">
                Enroll Now
              </a>
            </div>
          </div>
        </div>
      </div>
      <div data-popper-arrow></div>
    </div>
  </div>
</a>
