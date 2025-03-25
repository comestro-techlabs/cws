<div class="p-6 bg-gray-100 min-h-screen">
    @if(!$selectedCourse)
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">My Certificates</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $course->title }}</h3>
                        
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Certificate Approved</span>
                        </div>

                        <button wire:click="selectCourse({{ $course->id }})"
                            class="px-4 py-2 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 text-sm"
                            x-data
                            x-on:click="() => {
                                Swal.fire({
                                    title: 'Congratulations! 🎉',
                                    text: 'You have completed this course successfully!',
                                    icon: 'success',
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                                
                                let duration = 3000;
                                let end = Date.now() + duration;
                                
                                (function frame() {
                                    confetti({
                                        particleCount: 3,
                                        angle: 60,
                                        spread: 55,
                                        origin: { x: 0 },
                                        colors: ['#ff0000', '#00ff00', '#0000ff']
                                    });
                                    confetti({
                                        particleCount: 3,
                                        angle: 120,
                                        spread: 55,
                                        origin: { x: 1 },
                                        colors: ['#ff0000', '#00ff00', '#0000ff']
                                    });

                                    if (Date.now() < end) {
                                        requestAnimationFrame(frame);
                                    }
                                }());
                            }">
                            View Certificate
                        </button>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12 bg-white rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No Certificates Yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Complete your courses to earn certificates.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    @else
        @if($certificate)
            <div class="flex flex-col items-center">
                <!-- Certificate Preview -->
                <div class="w-full flex justify-between items-center mb-6">
                    <button wire:click="selectCourse(null)" class="text-gray-600 hover:text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Certificates
                    </button>
                    <div class="flex gap-4">
                        <button type="button" onclick="window.printCert()" 
                            class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Print Certificate
                        </button>
                        <button type="button" onclick="window.saveCert()" 
                            class="px-4 py-2 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Save as PNG
                        </button>
                    </div>
                </div>

                <div id="certificate-container" class="relative w-[995px] h-[695px] mx-auto bg-white shadow-xl">
                    <div class="w-full h-full bg-no-repeat bg-cover" style="background-image: url('{{ asset('certificate.jpeg') }}')">
                        <div class="relative w-full h-full">
                            <!-- Certificate content -->
                            <div class="absolute top-[350px] left-1/2 transform -translate-x-1/2">
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Great Vibes', cursive;">
                                    {{ auth()->user()->name }}
                                </h2>
                            </div>
                            <div class="absolute top-[420px] left-[100px] right-[90px] px-8">
                                <p class="text-lg text-gray-800">
                                    This certificate is awarded to <strong class="text-black">{{ $certificate->user->name }}</strong> 
                                    for achieving a score of <strong class="text-black">{{ number_format($certificate->overall_percentage, 2) }}%</strong> 
                                    in recognition of their performance in the final examination, viva voce, and project evaluation 
                                    for the course titled <strong class="text-black">{{ $certificate->course->title }}</strong>, 
                                    conducted by <strong>Comestro Techlabs Pvt Ltd.</strong>
                                </p>
                            </div>
                            <div class="absolute top-[330px] right-[-75px] transform rotate-90 text-gray-800 font-semibold text-lg tracking-wider">
                                Certificate No: {{ $certificate->certificate_no }}
                            </div>
                            <div class="absolute bottom-[25px] left-[510px]">
                                <p class="text-lg text-gray-800 text-center">{{ $certificate->date->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>