<div>
<div class="bg-white overflow-x-hidden">
    <livewire:page-heading 
        title="Our Contact"
        description="We're here to help with all your software development needs. Whether you have inquiries, require technical support, or want to discuss a project idea, our dedicated team is here to assist you. Reach out to us today and let's build something exceptional together."
        image="about-header.png" 
    />

    <section class="py-16 px-4 sm:px-8 lg:px-16 max-w-screen-xl mx-auto" id="contact-form">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Info Section -->
            <div class="space-y-6">
                <!-- ...existing contact info content... -->
            </div>
            
            <!-- Map Section -->
            <div class="flex items-center justify-center">
                <iframe class="rounded-xl w-full h-64 sm:h-72 md:h-96"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.629023335638!2d87.46747347465347!3d25.782814277338673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff97801471a9f%3A0xf8f622c46e9afaa9!2sLearn Syntax%20(Code%20with%20SadiQ)!5e0!3m2!1sen!2sin!4v1725219952931!5m2!1sen!2sin"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <section class="py-16 px-4 sm:px-8 md:px-20 bg-gray-100">
        <div class="flex flex-col items-center justify-center text-center">
            <h1 class="text-2xl sm:text-3xl font-bold mb-5">Get in touch with us!</h1>
            <p class="text-sm sm:text-base text-slate-700">Our Software Development team is always keen to help. For any queries/suggestions, kindly give us a call, send us an email, or fill out the form below.</p>
            <span class="elementor-divider-separator"></span>
        </div>

        <form wire:submit.prevent="submit" class="mt-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="flex flex-col">
                    <input type="text" wire:model="name" placeholder="Name"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col">
                    <input type="email" wire:model="email" placeholder="Email (optional)"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-col mt-5">
                <input type="tel" wire:model="mobile" placeholder="Mobile No."
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('mobile') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="mt-5">
                <textarea wire:model="message" placeholder="Message (optional)" rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="g-recaptcha mt-8 flex justify-center" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
            @error('recaptcha') <span class="text-red-500 text-sm mt-1 text-center block">{{ $message }}</span> @enderror

            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="bg-secondary text-white px-8 py-2 rounded-full shadow-md font-medium hover:bg-orange-600 transition duration-300">
                    Send Message
                </button>
            </div>
        </form>
    </section>

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
