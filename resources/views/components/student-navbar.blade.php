@props(['hasCompleted' => false, 'main' => ''])

<div x-data="{ sidebarOpen: false }">
    <button @click="sidebarOpen = !sidebarOpen" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-700 rounded-lg sm:hidden hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>
    <aside id="default-sidebar" 
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r border-gray-100">
            <div class="flex flex-col items-center pb-5">
                <img class="w-24 h-24 mb-3 rounded-full ring-2 ring-purple-600 ring-offset-2" src="{{ asset('user.png') }}" alt="User Profile" />
                <h5 class="mb-1 text-sm font-medium text-gray-900 capitalize">
                    @if (auth()->check())
                        {{ auth()->user()->name }}
                    @endif
                </h5>
                @if (auth()->check() && auth()->user()->is_member)
                    <span class="px-3 py-1 text-sm font-medium text-purple-700 bg-purple-50 rounded-full">
                        Member
                    </span>
                @endif

                @if(auth()->check() && auth()->user()->barcode)
                    <div class="p-4 mt-2 bg-white rounded-lg shadow-sm">
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG(auth()->user()->barcode, 'C128') }}"
                        alt="barcode" class="w-full">
                    </div>
                @endif
            </div>

            <div class="space-y-1">
                <a wire:navigate href="{{ route('v2.student.dashboard') }}" 
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-yellow-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>
                    Dashboard
                </a>

                <a wire:navigate href="{{ route('student.exploreCourses') }}" 
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    </svg>
                    Explore Courses
                </a>

                <a wire:navigate href="{{ route('student.billing') }}" 
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                        <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                    </svg>
                    Billing
                </a>

                <a wire:navigate href="{{ route('student.messages') }}" 
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6.912 3a3 3 0 0 0-2.868 2.118l-2.411 7.838a3 3 0 0 0-.133.882V18a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0 0 17.088 3H6.912Zm13.823 9.75-2.213-7.191A1.5 1.5 0 0 0 17.088 4.5H6.912a1.5 1.5 0 0 0-1.434 1.059L3.265 12.75H6.11a3 3 0 0 1 2.684 1.658l.256.513a1.5 1.5 0 0 0 1.342.829h3.218a1.5 1.5 0 0 0 1.342-.83l.256-.512a3 3 0 0 1 2.684-1.658h2.844Z" clip-rule="evenodd" />
                    </svg>
                    Messages
                </a>

                <a wire:navigate href="{{ route('v2.student.mycourses') }}" 
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-teal-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    </svg>
                    My Courses
                </a>

                <a wire:navigate href="{{ route('student.assignments-view') }}" 
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                    </svg>
                    Assignments
                </a>

                @if (isset($hasCompleted) && $hasCompleted)
                    <a wire:navigate href="{{ route('v2.student.examResult') }}" 
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                        </svg>
                        Exam Results
                    </a>
                @endif

                <a wire:navigate href="{{ route('student.takeExam') }}"
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 fill-pink-600">
                        <path fill-rule="evenodd"
                            d="M10.5 3.798v5.02a3 3 0 0 1-.879 2.121l-2.377 2.377a9.845 9.845 0 0 1 5.091 1.013 8.315 8.315 0 0 0 5.713.636l.285-.071-3.954-3.955a3 3 0 0 1-.879-2.121v-5.02a23.614 23.614 0 0 0-3 0Zm4.5.138a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                            clip-rule="evenodd" />
                    </svg>
                    Take Examinations
                </a>

                @if (isset($hasCompleted) && $hasCompleted)
                    <a href="{{ route('student.certificate', ['userId' => Auth::id()]) }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6 fill-orange-600">
                            <path fill-rule="evenodd"
                                d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 0 0-.584.859 6.753 6.753 0 0 0 6.138 5.6 6.73 6.73 0 0 0 2.743 1.346A6.707 6.707 0 0 1 9.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 0 0-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 0 1-1.112-3.173 6.73 6.73 0 0 0 2.743-1.347 6.753 6.753 0 0 0 6.139-5.6.75.75 0 0 0-.585-.858 47.077 47.077 0 0 0-3.07-.543V2.62a.75.75 0 0 0-.658-.744 49.22 49.22 0 0 0-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 0 0-.657.744Zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 0 1 3.16 5.337a45.6 45.6 0 0 1 2.006-.343v.256Zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 0 1-2.863 3.207 6.72 6.72 0 0 0 .857-3.294Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Certificate</span>
                    </a>
                @endif

                <a wire:navigate href="{{ route('student.v2edit.profile') }}"
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 fill-blue-600">
                        <path fill-rule="evenodd"
                            d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                            clip-rule="evenodd" />
                        <path
                            d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                        <path fill-rule="evenodd"
                            d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Profile Settings</span>
                </a>
                <a wire:navigate href="{{ route('student.my-attendance')}}"
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 fill-blue-600">
                        <path fill-rule="evenodd"
                            d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                            clip-rule="evenodd" />
                        <path
                            d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                        <path fill-rule="evenodd"
                            d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">My Attendance</span>
                </a>
                @if (!auth()->user()->is_member)
                    <button type="" id="membership-pay-button"
                        class="flex justify-start w-full p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green"
                            class="size-6">
                            <path fill-rule="evenodd"
                                d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="ms-3 whitespace-nowrap">Become a Member</span>
                    </button>
                @endif

                <a wire:navigate href="{{ route('auth.logout') }}"
                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 fill-red-600">
                        <path fill-rule="evenodd"
                            d="M12 2.25a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM6.166 5.106a.75.75 0 0 1 0 1.06 8.25 8.25 0 1 0 11.668 0 .75.75 0 1 1 1.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                </a>
            </div>
        </div>
    </aside>

    <div class="sm:ml-64 transition-all duration-300"> 
        {{ $main ?? '' }}
    </div>
    
<!-- will put this inside proper livewire tags -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@auth
<script>

    document.getElementById('membership-pay-button').onclick = function(e) {
        const payButton = document.getElementById('membership-pay-button');
        payButton.disabled = true;
        e.preventDefault();

        const receipt_no = `${Date.now()}`;

        let member_fee = 700;

        // First, initiate payment by sending the details to the backend
        fetch("{{ route('store.payment.initiation') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    student_id: "{{ Auth::id() }}" ?? 99,
                    receipt_no: receipt_no,
                    amount: member_fee,
                    ip_address: "{{ request()->ip() }}",
                    workshop_id:  null,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // console.log("check wp and crs id",data.workshop_id,data.course_id);
                    // Use the Razorpay order_id received from backend
                    var options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": member_fee, // amount in paise
                        "currency": "INR",
                        "name": "LearnSyntax",
                        "description": "Processing Fee",
                        "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                        "order_id": data.order_id, // Razorpay order ID
                        "handler": function(response) {
                            // After successful payment, send the payment details to the backend
                            fetch("{{ route('handle.payment.response') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({
                                        payment_id: data.payment_id, // Payment ID created in the backend
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                    })
                                })
                                .then(response => {
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        alert('Payment processed successfully');
                                        window.location.href = '/student/billing';
                                    } else {
                                        alert('Payment failed: ' + data.message);
                                        payButton.disabled = false;
                                    }
                                })
                                .catch(error => {
                                    console.error("Error in updating payment:", error);
                                    payButton.disabled = false;
                                });
                        },
                        "prefill": {
                            "name": "{{ Auth::user()->name }}",
                            "email": "{{ Auth::user()->email }}"
                        },
                        "theme": {
                            "color": "#0a64a3"
                        },
                        "modal": {
                            "ondismiss": function() {
                                alert('Payment process was cancelled.');
                                payButton.disabled = false;
                                document.forms[0].submit();
                            }
                        }
                    };

                    // Open the Razorpay payment modal
                    var rzp1 = new Razorpay(options);
                    rzp1.open();

                } else {
                    alert("Error initiating payment: " + data.message);
                    payButton.disabled = false;
                }
            })
            .catch(error => {
                console.error("Error initiating payment:", error);
                payButton.disabled = false;
            });
    };
</script>
@endauth
</div>
