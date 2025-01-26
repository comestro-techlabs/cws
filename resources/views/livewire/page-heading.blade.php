<div class="w-full">
    <section class="bg-blue-900 text-white py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <!-- Text Content -->
            <div class="text-center ml-16 md:text-left mb-8 md:mb-0m mt-10  md:w-1/2">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 mt-5">{{$title}}</h1>
                <p class="text-md md:text-lg mb-6">
                    {{$description}}
                </p>
                <div class="flex md:flex-row items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-5 rounded-full w-40">
                    <a href="{{route('public.contact')}}"
                        class="">
                        GET Started
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                      </svg>
                    {{-- <a href="tel:+919546805580"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-5 rounded-full">
                        Call: {{env('PHONE_NO')}}
                    </a> --}}
                </div>
            </div>
            <!-- Image -->
            <div class="md:flex justify-center hidden md:justify-end md:w-1/2 px-4">
                <img src="{{asset('assets/'.$image)}}" alt="{{$title}}" class="max-w-full h-auto mt-14 rounded-lg">
            </div>
        </div>
    </section>
    <div class="bend-bottom bg-blue-900 hidden md:flex"></div>
</div>
