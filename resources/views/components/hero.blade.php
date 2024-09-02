<div>
    <div class="relative flex flex-1 md:flex-row flex-col bg-slate-100 h-auto md:h-[500px] my-0 py-7 md:py-2 items-center px-5 md:px-[10%] overflow-hidden">
        <!-- Background Image and Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-l z-10 from-slate-900 via-slate-800 to-black opacity-60"></div>
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{asset('assets/banner.png')}}');"></div>

        <div class="relative flex-1 flex-col gap-1 z-50">
            <h1 class="md:text-5xl text-3xl font-semibold leading-normal text-white">
                Purnea's <span class="text-orange-500">Most Trusted</span> Software Company
            </h1>
            <p class="text-lg md:text-xl font-light text-gray-200 mt-2">
                Empowering you with the skills to achieve your dreams. Start your journey towards success today!
            </p>
            <br>


            <!-- hire Us -->
            <!-- Modal toggle -->
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white text-lg bg-orange-600 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-6 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">
                Hire Us
            </button>

            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center  md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Enter your Required Details
                            </h3>
                            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="{{route('public.hireUs')}}" method="post">
                                @csrf
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex: denish riche" />

                                    @error('name')
                                    <p class="text-red-500 text-xs font-semibold">{{$message}}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Contact</label>
                                    <input type="number" name="contact" id="contact" placeholder="Ex: 9988776655" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />

                                    @error('contact')
                                    <p class="text-red-500 text-xs font-semibold">{{$message}}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </form>
                        </div>
                        <!-- popup after Registeration😊 -->
                        @session('success')
                        <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                                    <div class="p-4 md:p-5 text-center">

                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Thanks For Registeration😊</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endsession

                    </div>
                </div>
            </div>

        </div>

    </div>


</div>