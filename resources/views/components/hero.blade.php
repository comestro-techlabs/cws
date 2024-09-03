<div>
    <div class="relative flex flex-1 md:flex-row flex-col bg-slate-100 h-auto md:h-[500px] my-0 py-7 md:py-2 items-center px-5 md:px-[10%] overflow-hidden">
        <!-- Background Image and Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r z-10 from-slate-100 via-slate-500 to-black opacity-50"></div>
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/banner.png') }}');"></div>

        <div class="relative flex-1 flex-col max-w-lg ml-5 gap-1 z-50">
            <h1 class="md:text-5xl text-3xl font-semibold leading-normal text-gray-900">
                Purnea's <span class="text-orange-500">Most Trusted</span> Software Company
            </h1>
            <p class="text-lg md:text-xl font-normal text-gray-900 mt-4">
                Empowering you with the skills to achieve your dreams. Start your journey towards success today!
            </p>
            <br>

            <!-- Error Handling -->
            @if ($errors->any())
                <div class="text-red-500 font-semibold">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div id="success-modal" class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
                    <div class="relative p-4 w-full max-w-md">
                        <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-800">
                            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Success
                                </h3>
                                <button type="button" onclick="closeSuccessModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="p-6 text-center">
                                <svg class="w-16 h-16 mx-auto text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 4.6v-7.8c0-1.68-1.32-3.05-3-3.05H6c-1.68 0-3 1.37-3 3.05v7.8c0 1.68 1.32 3.05 3 3.05h12c1.68 0 3-1.37 3-3.05z" />
                                </svg>
                                <p class="text-lg md:text-xl font-light text-gray-900 dark:text-white mb-4">
                                    {{ session('success') }}
                                </p>
                                <button onclick="closeSuccessModal()" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Hire Us Form -->
            <button onclick="toggleModal()" class="block text-white text-lg bg-orange-600 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-6 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800" type="button">
                Hire Us
            </button>

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
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="E.g Rajesh Kumar" required />

                                    @error('name')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                                    <input type="number" name="mobile" id="mobile" placeholder="E.g 99999-99999" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />

                                    @error('mobile')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                                    <textarea type="text" name="message" id="message" placeholder="E.g 99999-99999" class="bg-gray-50 border resize-none border-gray-300  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                                    </textarea>

                                    @error('message')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full text-white bg-orange-700  hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Send Information</button>
                                
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
