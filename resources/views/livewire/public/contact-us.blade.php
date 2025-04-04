<div>
    <div class="bg-white overflow-x-hidden">
        <livewire:page-heading title="Our Contact"
            description="We're here to help with all your software development needs. Whether you have inquiries, require technical support, or want to discuss a project idea, our dedicated team is here to assist you. Reach out to us today and let's build something exceptional together."
            image="about-header.png" />

        <section class="py-16 px-4 sm:px-8 lg:px-16 max-w-screen-xl mx-auto" id="contact-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contact Info Section -->
                <div class="space-y-6">
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left">
                        <h1 class="text-lg font-semibold text-slate-600">Contact Us for Learning Services</h1>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">How To Contact Us?</h2>
                        <p class="text-sm md:text-base mt-4 text-slate-600 font-semibold">We have great, flexible
                            support via live chat, email, and phone.</p>
                    </div>

                    <div class="flex justify-center sm:justify-start my-4">
                        <span class="elementor-divider-separator block w-1/2 sm:w-full"></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 justify-center sm:justify-start">
                        <div
                            class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/location.png" alt="Location Image"
                                class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Visit our Office.</p>
                                <h1 class="text-sm text-black mt-2">Ramavtar Market Thana Chowk, near Dog Hospital,
                                    Gandhi Nagar, Madhubani, Purnia, Bihar 854301
                                </h1>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/email.png" alt="Email Image"
                                class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Have a Learning in mind?<br>Send a message.</p>
                                <h1 class="text-md font-bold text-black mt-2"> info@Learnsyntax.com</h1>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/phone.png" alt="Phone Image"
                                class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Have a Learning in <br> mind? Send a message.</p>
                                <h1 class="text-md font-bold text-black mt-2">(+91) 9546805580</h1>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/whatapp.png" alt="WhatsApp Image"
                                class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Would you like to <br> join our growing team?</p>
                                <h1 class="text-md font-bold text-black mt-2">(+91) 9546805580</h1>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Map Section -->
                <div class="flex items-center justify-center">
                    <iframe class="rounded-xl w-full h-64 sm:h-72 md:h-96"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.629023335638!2d87.46747347465347!3d25.782814277338673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff97801471a9f%3A0xf8f622c46e9afaa9!2sLearn Syntax%20(Code%20with%20SadiQ)!5e0!3m2!1sen!2sin!4v1725219952931!5m2!1sen!2sin"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>

        <div class="flex px-[16%] ">
            <section class="py-16 px-4 sm:px-8 md:px-20  rounded-lg md:pb-10">
                <div class="flex flex-col items-center justify-center text-center">
                    <h1 class="text-2xl sm:text-3xl font-bold mb-5">Get in touch with us!</h1>
                    <p class="text-sm sm:text-base text-slate-700">Our Software Development team is always keen to help.
                        For any queries/suggestions, kindly give us a call, send us an email, or fill out the form
                        below.</p>
                    <span class="elementor-divider-separator"></span>
                </div>

                <form wire:submit.prevent="submit" class="mt-5 bg-gray-200 p-8 rounded-2xl shadow-lg max-w-4xl mx-auto">
                    <!-- Name and Email Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Full Name</label>
                            <div class="relative">
                                <input type="text" wire:model="name" placeholder="Enter your name"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-gray-100">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Email Address (Optional)</label>
                            <div class="relative">
                                <input type="email" wire:model="email" placeholder="Enter your email"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-gray-100">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group mt-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Mobile Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <span class="text-gray-500">+91</span>
                            </div>
                            <input type="tel" wire:model="mobile" placeholder="Enter your mobile number"
                                class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-gray-100">
                        </div>
                        @error('mobile') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Message -->
                    <div class="form-group mt-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Message (Optional)</label>
                        <textarea wire:model="message" rows="4" placeholder="Type your message here..."
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-gray-100 resize-none"></textarea>
                        @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="mt-8">
                        <div class="g-recaptcha flex justify-center"
                            data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @error('recaptcha') <span
                            class="text-red-500 text-sm mt-1 text-center block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit"
                            class="group relative w-full md:w-auto px-8 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-lg overflow-hidden transition-all duration-300 hover:from-purple-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">

                            <!-- Background Animation -->
                            <div
                                class="absolute inset-0 w-full h-full transition-all duration-300 group-hover:bg-black/10">
                            </div>

                            <!-- Content Container -->
                            <div class="relative flex items-center justify-center space-x-3">
                                <!-- Icon -->
                                <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>

                                <!-- Text -->
                                <span class="text-base">Send Message</span>

                                <!-- Loading Spinner -->
                                <svg wire:loading class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </section>
        </div>

        @script
        <script>
        // Sweet Alert for success/error messages
        $wire.on('success', (message) => {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                confirmButtonColor: '#0272bd'
            });
        });

        $wire.on('error', (message) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
                confirmButtonColor: '#0272bd'
            });
        });
        </script>
        @endscript
    </div>
</div>