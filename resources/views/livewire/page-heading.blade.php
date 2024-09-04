<div class="w-full">
    <section class="bg-blue-900 text-white py-12" style="padding-top: 6.5rem;">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <!-- Text Content -->
            <div class="text-start md:text-left mb-8 md:mb-0 w-1/2">
                <h1 class="text-4xl font-bold mb-4">{{$title}}</h1>
                <p class="mb-6">
                    {{$description}}
                </p>
                <div class="flex ">
                    <a href="#"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-5 rounded-full mr-4">
                        GET FREE TUTORIAL
                    </a>
                    <a href="tel:+919546805580"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-5 rounded-full">
                        Call: +91-9546-8055-80
                    </a>
                </div>
            </div>
            <!-- Image -->
            <div class="flex justify-center md:w-1/2 px-8">
                <img src="{{asset('assets/'.$image)}}" alt="{{$title}}" class="max-w-full h-auto">
            </div>
        </div>
    </section>
    <div class="bend-bottom bottom-0 left-0 w-full h-16 bg-blue-900"></div>

</div>
