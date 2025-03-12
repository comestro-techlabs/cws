<div>
    <h1>Student Details</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 ">
        <!-- Parent ID -->
        <div class="bg-slate-100 p-3 rounded  hover:bg-gray-50 ">
            <strong class="block text-lg font-semibold text-slate-600">Name</strong>
            <span class="text-slate-500">{{ $student->name }}</span>
        </div>

        <!-- Level -->
        <div class="bg-slate-100 p-3 rounded hover:bg-gray-50">
            <strong class="block text-lg font-semibold text-slate-600">Email</strong>
            <span class="text-slate-500">{{ $student->email }}</span>
        </div>

        <!-- Name -->
        <div class="bg-slate-100 p-3 rounded hover:bg-gray-50">
            <strong class="block text-lg font-semibold text-slate-600">Contact</strong>
            <span class="text-slate-500">{{ $student->contact }}</span>
        </div>

        <!-- Order Level -->
        <div class="bg-slate-100 p-3 rounded hover:bg-gray-50">
            <strong class="block text-lg font-semibold text-slate-600">Gender</strong>
            <span class="text-slate-500">{{ $student->gender }}</span>
        </div>
        <div class="bg-slate-100 p-3 rounded hover:bg-gray-50">
            <strong class="block text-lg font-semibold text-slate-600">Education_qualification</strong>
            <span class="text-slate-500">{{ $student->education_qualification }}</span>
        </div>
        <div class="bg-slate-100 p-3 rounded hover:bg-gray-50">
            <strong class="block text-lg font-semibold text-slate-600">DOB</strong>
            <span class="text-slate-500">{{ $student->dob }}</span>
        </div>


    </div>
    <!-- Tabs -->
    <div class="flex border-b mt-4">
        <button wire:click="setActiveTab('courses')" class="px-4 py-2 focus:outline-none"
            :class="{ 'border-b-2 border-blue-500 font-bold': activeTab === 'courses' }">
            Courses
        </button>
        <button wire:click="setActiveTab('membership')" class="px-4 py-2 focus:outline-none"
            :class="{ 'border-b-2 border-blue-500 font-bold': activeTab === 'membership' }">
            Membership
        </button>
        <button wire:click="setActiveTab('enrolled')" class="px-4 py-2 focus:outline-none"
            :class="{ 'border-b-2 border-blue-500 font-bold': activeTab === 'enrolled' }">
            Enrolled Courses
        </button>
    </div>
    <!-- Courses Table -->
    @if($activeTab === 'courses')
    <div class="flex justify-center">
        <button class="group relative mt-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium py-2.5 px-5 rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" wire:click="enrollButtonOpenModal">
            <span class="flex items-center">
                <span>Enroll in new course</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:rotate-45 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </span>
            <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
        </button>
    </div>
    <div class="mt-4">
        <h3 class="text-lg font-semibold">Purchased Courses</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-200 text-center">

                <tr>
                    <th class="p-2 text-centert text-xs font-medium text-gray-600 border">Course</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Order Id</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Status</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Method</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Amount</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Date</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Month</th>
                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Year</th>

                </tr>

            </thead>
            <tbody>
                @forelse($purchasedCourses as $payment)
                <tr class="text-center">
                    <td class="px-4 py-2 border">{{ $payment->course->title ?? 'Unknown Course' }}</td>
                    <td class="px-4 py-2 border">{{ $payment->order_id }}</td>
                    <td class="px-4 py-2 border text-green-500">Paid</td>
                    <td class="px-4 py-2 border">{{ $payment->method }}</td>
                    <td class="px-4 py-2 border">{{ $payment->total_amount }}</td>
                    <td class="px-4 py-2 border">{{ $payment->payment_date}}</td>
                    <td class="px-4 py-2 border">{{ $payment->month }}</td>
                    <td class="px-4 py-2 border">{{ $payment->year }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-4 py-2 text-center">No courses purchased.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    <!-- Membership Table -->
    @if($activeTab === 'membership')
    <div class="mt-4">
        @if(!$isMember)
        <div class="flex justify-center">
            <button class="group relative mt-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium py-2.5 px-5 rounded-lg shadow-lg hover:shadow-blue-500/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" wire:click="createFuturePayment">
                <span class="flex items-center">
                    <span>Activate membership</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:rotate-45 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
            </button>
        </div>
        @endif
        <h3 class="text-lg font-semibold">Membership Details</h3>
        <div wire:key="payment-table">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Due Date</th>
                    <th class="px-4 py-2 border">Month</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Method</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Payment Date</th>
                    <th class="px-4 py-2 border">Action</th>

                </tr>
            </thead>
            <tbody>
                @if($isMember)
                @foreach($lastPayment as $payment)
                @if(empty($payment->course_id) && empty($payment->workshop_id))
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 border-b text-sm text-gray-700 text-center">{{ $payment->due_date }}</td>
                    <td class="px-4 py-3 border-b text-sm font-medium text-center">{{ \Carbon\Carbon::create((int)$payment->year, (int)$payment->month, 1)->format('M Y') }}</td>
                    <td class="px-4 py-3 border-b text-sm font-semibold text-center">{{ $payment->total_amount }}</td>
                    <td class="px-4 py-3 border-b text-sm text-center">
                        <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">{{ $payment->method }}</span>
                    </td>
                    <td class="px-4 py-3 border-b text-center">
                        @if($payment->status == 'captured')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $payment->status }}
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            {{ $payment->status }}
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 border-b text-sm text-green-700 text-center">
                        @if($payment->status == 'captured')
                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y, h:i A') }}
                        @endif
                    </td>

                    <td class="px-4 py-3 border-b text-center">
                        @if($payment->status != 'captured')
                        <button wire:click="payWithCash({{ $payment->id }})" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Pay with cash
                        </button>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach

                @else
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center">Not a member</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>
    @endif


    <!-- Enrolled Courses Table -->
    @if($activeTab === 'enrolled')
    <div class="mt-4">
        <h3 class="text-lg font-semibold">Enrolled Courses</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Course Name</th>
                    <th class="px-4 py-2 border">Batch ID</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td class="px-4 py-2 border">{{ $course->title }}</td>
                    <td class="px-4 py-2 border">{{ $course->pivot->batch_id ?? 'No Batch Selected' }} </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-4 py-2 text-center">No courses enrolled.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
    <!-- modal -->
    @if($isModalOpen)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-2xl p-6 m-4 transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Enroll in New Course</h2>
                <button wire:click="enrollButtonCloseModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="relative mb-6">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model="searchTerm" placeholder="Search courses..." class="w-full pl-10 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>

            <div class="max-h-64 overflow-y-auto pr-1 mb-6">
                <ul class="space-y-3">
                    @forelse($availableCourses as $course)

                    <li class="p-4 bg-white border border-gray-100 rounded-xl hover:shadow-md hover:border-blue-100 transition-all duration-200 flex flex-wrap md:flex-nowrap justify-between items-center gap-3">
                        <div class="flex-grow">
                            <h3 class="text-gray-800 font-semibold">{{ $course->title }}</h3>
                            <div class="mt-1 flex items-center">
                                <span class="bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 font-medium px-3 py-1 rounded-lg flex items-center">
                                    ₹ {{ $course->discounted_fees }}
                                </span>
                            </div>
                        </div>
                        <button wire:click="enrollCourse({{ $course->id }})" class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <span class="relative z-10 flex items-center">
                                <span>Enroll</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </button>
                    </li>
                    @empty
                    <li class="p-6 text-center text-gray-500">No courses available.</li>
                    @endforelse
                </ul>
            </div>

            <div class="flex justify-end">
                <button wire:click="enrollButtonCloseModal" class="text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium py-2.5 px-5 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    @endif
</div>