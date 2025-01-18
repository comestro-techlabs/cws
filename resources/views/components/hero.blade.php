
<div class="bg-primary  overflow-x-hidden">
    <div class="relative flex py-12 flex-col md:flex-row bg-slate-100 h-auto md:h-[500px] my-0 py-7 md:py-2 items-center px-5 md:px-[10%] overflow-hidden ">
        <!-- Background Image and Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/banner.png') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r z-10 from-slate-100 via-slate-500 to-black opacity-50"></div>

        <div class="relative flex-1 flex-col max-w-lg ml-5 gap-1 z-50">
            <h1 class="md:text-5xl roboto-bold text-3xl font-semibold leading-normal text-primary">
                Purnea's <span class="text-primary">Most Trusted</span> Software Company
            </h1>
            <p class="text-lg md:text-xl font-normal mt-4 md:text-slate-800">
                Empowering you with the skills to achieve your dreams. Start your journey towards success today!
            </p>

            <br>




            <!-- Hire Us Form -->
            <div class="md:flex-row flex-col flex  items-center  gap-3">
                <button onclick="toggleModal()" class="flex w-52 md:w-40 justify-center text-white flex-1 text-lg bg-primary hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-6 py-2.5 text-center  items-center gap-1 " type="button">
                    <svg class="size-7 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" d="M12 18.5A2.493 2.493 0 0 1 7.51 20H7.5a2.468 2.468 0 0 1-2.4-3.154 2.98 2.98 0 0 1-.85-5.274 2.468 2.468 0 0 1 .92-3.182 2.477 2.477 0 0 1 1.876-3.344 2.5 2.5 0 0 1 3.41-1.856A2.5 2.5 0 0 1 12 5.5m0 13v-13m0 13a2.493 2.493 0 0 0 4.49 1.5h.01a2.468 2.468 0 0 0 2.403-3.154 2.98 2.98 0 0 0 .847-5.274 2.468 2.468 0 0 0-.921-3.182 2.477 2.477 0 0 0-1.875-3.344A2.5 2.5 0 0 0 14.5 3 2.5 2.5 0 0 0 12 5.5m-8 5a2.5 2.5 0 0 1 3.48-2.3m-.28 8.551a3 3 0 0 1-2.953-5.185M20 10.5a2.5 2.5 0 0 0-3.481-2.3m.28 8.551a3 3 0 0 0 2.954-5.185"/>
                      </svg>

                    Hire Us
                </button>
                <a class="gap-2 bg-white/70 text-green-600 text-lg  focus:ring-4 focus:outline-none focus:ring-blue-300  flex items-center font-medium rounded-lg px-6 py-2.5 text-center" href="tel:{{env('PHONE_NO')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 fill-green-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
            </svg>
            {{env('PHONE_NO')}}</a>
            </div>

            <!-- Main Modal -->
            <div id="authentication-modal" class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
                <div class="relative p-4 w-full max-w-sm max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-md font-semibold text-gray-900 dark:text-white">
                                Enter your Required Details
                            </h3>
                            <button type="button" onclick="toggleModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="p-2 md:p-3">
                            <form class="space-y-2" action="{{ route('enquiry.store') }}" method="post">
                                @csrf
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                                    <input type="text" name="name" id="name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="E.g Rajesh Kumar" required />

                                    @error('name')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                                    <input type="number" name="mobile" id="mobile" placeholder="E.g 99999-99999" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />

                                    @error('mobile')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                                    <textarea name="message" id="message" placeholder="E.g 99999-99999" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>

                                    @error('message')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Send Information</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
<script>
function toggleModal() {
    const modal = document.getElementById('authentication-modal');
    modal.classList.toggle('hidden');
}

function closeSuccessModal() {
    const modal = document.getElementById('success-modal');
    modal.classList.add('hidden');
}
</script>
