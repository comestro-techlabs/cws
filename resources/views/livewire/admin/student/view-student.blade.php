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
        <h3 class="text-lg font-semibold">Membership Details</h3>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Membership Status</th>
                    <th class="px-4 py-2 border">Active</th>
                    <th class="px-4 py-2 border">Last Payment</th>
                    <th class="px-4 py-2 border">Payment Due</th>
                    <th class="px-4 py-2 border">Overdue Days</th>
                </tr>
            </thead>
            <tbody>
                @if($isMember)
                <tr>
                    <td class="px-4 py-2 border text-green-500">
                        {{ $isMember ? 'Member' : 'Not a Member' }}
                    </td>
                    <td class="px-4 py-2 border text-green-500">
                        {{ $isActive ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $lastPayment ? $lastPayment->payment_date : 'No Payments' }}
                    </td>
                    <td class="px-4 py-2 border text-red-500">
                        {{ $isPaymentDue ? 'Payment Due' : 'No Dues' }}
                    </td>
                    <td class="px-4 py-2 border text-red-500">
                        {{ $isPaymentDue ? $overdueDays . ' days' : 'N/A' }}
                    </td>
                </tr>
                @else
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center">Not a member</td>
                </tr>
                @endif
            </tbody>
        </table>
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
                            <td class="px-4 py-2 border">{{ $course->pivot->batch_id ?? 'No Batch Selected' }}   </td>
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
</div>