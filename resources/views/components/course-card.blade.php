  {{-- <div
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
   
  </div>
 --}}

<div
   {{-- data-popover-target="popover-course-details{{$course->id}}" data-popover-placement="right" --}}
     class="flex border border-slate-300 rounded-t-xl rounded-b-xl w-full max-w-xs flex-col bg-white text-gray-700">
    {{-- <a href="{{route('public.courseDetails',['category_slug' => $course->category->cat_slug, 'slug' =>  $course->slug])}}" class="flex flex-1 flex-col"> --}}
      <a href="{{ route('public.courseDetails', ['category_slug' => optional($course->category)->cat_slug, 'slug' => $course->slug]) }}">

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
        @auth
            <form action="{{ route('public.enrollCourse', ['courseId' => $course->id]) }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full py-3.5 px-7 text-center bg-gray-900 text-white rounded-lg text-sm font-bold uppercase shadow-md hover:shadow-lg transition-all">
                    Enroll Now
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="w-full py-3.5 px-7 text-center bg-gray-900 text-white rounded-lg text-sm font-bold uppercase shadow-md hover:shadow-lg transition-all">
                Login to Enroll
            </a>
        @endauth
    </div>
    
      {{-- <div class="flex flex-1 justify-center mt-2">
        <a href="{{route('public.courseDetails',['category_slug' => $course->category->cat_slug, 'slug' =>  $course->slug])}}" class="w-full py-3.5 px-7 text-center bg-gray-900 text-white rounded-lg text-sm font-bold uppercase shadow-md hover:shadow-lg transition-all">
          Enroll Now
        </a>
      </div> --}}
    </div>
    </a>
   
  </div>

