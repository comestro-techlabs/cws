<div class="min-h-screen bg-gray-50 py-8">
    <x-loader /> <!-- Add loader component -->
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Student Profile</h1>
            <p class="mt-1 text-sm text-gray-500">Manage student information, courses, and membership details</p>
        </div>

        <!-- Extended Student Details Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach([
                ['label' => 'Name', 'value' => $student->name],
                ['label' => 'Email', 'value' => $student->email],
                ['label' => 'Contact', 'value' => $student->contact],
                ['label' => 'Gender', 'value' => $student->gender],
                ['label' => 'Education', 'value' => $student->education_qualification],
                ['label' => 'Date of Birth', 'value' => $student->dob],
                ['label' => 'Registration Date', 'value' => $student->created_at->format('d M Y')],
                ['label' => 'Account Status', 'value' => $student->is_active ? 'Active' : 'Inactive'],
                ['label' => 'Student ID', 'value' => 'STU'.str_pad($student->id, 5, '0', STR_PAD_LEFT)]
            ] as $detail)
                <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-200">
                    <div class="text-sm font-medium text-gray-500">{{ $detail['label'] }}</div>
                    <div class="mt-1 text-lg font-semibold text-gray-900">{{ $detail['value'] }}</div>
                </div>
            @endforeach
        </div>
        <button wire:click="generateBarcode({{ $studentId }})" class="bg-blue-500 text-white py-2 px-4 rounded">Generate Barcode</button>

        <!-- Modal for barcode display -->
        @if ($showBarcodeModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <div class="text-center">
                        <h2 class="text-2xl font-semibold mb-4">Generated Barcode</h2>
                        <div class="mb-4">
                            <!-- Display the barcode here -->
                            <p class="text-xl">{{ $barcode }}</p>
                        </div>
                        <!-- Close Button -->
                        <button wire:click="closeBarcodeModal" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Close</button>
                    </div>
                </div>
            </div>
        @endif
        <!-- Modified Tabs Navigation -->
        <div class="mb-8 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                @foreach([
                    'courses' => 'Courses', 
                    'subscription' => 'Subscription Plan', 
                    'enrolled' => 'Enrolled Courses',
                    'payments' => 'Payment History'
                ] as $tab => $label)
                    <button wire:click="setActiveTab('{{ $tab }}')"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
                                   {{ $activeTab === $tab
                                      ? 'border-blue-500 text-blue-600'
                                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            @if($activeTab === 'courses')
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-900">Purchased Courses</h2>
                        <button wire:click="enrollButtonOpenModal"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Enroll in New Course
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-200 text-center">
                                <tr>
                                    <th class="p-2 text-centert text-xs font-medium text-gray-600 border">Course</th>
                                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Order Id</th>
                                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Status</th>
                                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Method</th>
                                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Amount</th>
                                    <th class="p-2 text-center text-xs font-medium text-gray-600 border">Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchasedCourses as $payment)
                                <tr class="text-center">
                                    <td class="px-4 py-2 border">{{ $payment->course->title ?? 'Unknown Course' }}</td>
                                    <td class="px-4 py-2 border">{{ $payment->order_id }}</td>
                                    <td class="px-4 py-2 border text-green-500">Paid</td>
                                    <td class="px-4 py-2 border">{{ $payment->payment_method }}</td>
                                    <td class="px-4 py-2 border">{{ $payment->total_amount }}</td>
                                    <td class="px-4 py-2 border">{{ $payment->formattedPaymentDate}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-4 py-2 text-center">No courses purchased.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

@if($activeTab === 'subscription')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($activeSubscription)
        <div class="mb-8">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-green-800">Current Active Subscription</h3>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-green-600">Plan:</p>
                        <p class="font-medium">{{ $activeSubscription->plan->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-green-600">Valid Until:</p>
                        <p class="font-medium">{{ $activeSubscription->ends_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Subscription Plans
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Choose the perfect plan for your learning journey
            </p>
        </div>

        <div class="mt-12 grid gap-8 lg:grid-cols-3">
            @foreach($subscriptionPlans as $plan)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden {{ $plan->slug === 'pro' ? 'border-2 border-purple-500' : '' }}">
                    <div class="px-6 py-8">
                        <h3 class="text-2xl font-bold text-purple-600">{{ $plan->name }}</h3>
                        <p class="mt-4 text-gray-500">{{ $plan->description }}</p>
                        <p class="mt-8">
                            <span class="text-4xl font-bold text-gray-900">₹{{ $plan->price }}</span>
                            <span class="text-gray-500">/{{ $plan->duration_in_days }} days</span>
                        </p>
                        <button 
                            wire:click="subscribePlan({{ $plan->id }})"
                            wire:loading.attr="disabled"
                            wire:target="subscribePlan({{ $plan->id }})"
                            @if($activeSubscription) disabled @endif
                            class="mt-8 w-full bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="subscribePlan({{ $plan->id }})">
                                {{ $activeSubscription ? 'Already Subscribed' : 'Subscribe with Cash' }}
                            </span>
                            <span wire:loading wire:target="subscribePlan({{ $plan->id }})">
                                Processing...
                            </span>
                        </button>
                    </div>
                    <div class="px-6 pt-6 pb-8">
                        <ul class="space-y-4">
                            @php
                                $planFeatures = is_string($plan->features) ? json_decode($plan->features, true) : $plan->features;
                            @endphp
                            @forelse($planFeatures ?? [] as $feature)
                                <li class="flex items-center space-x-3">
                                    <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-600">{{ $feature }}</span>
                                </li>
                            @empty
                                <li class="text-gray-500 text-sm">No features listed</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if($activeTab === 'enrolled')
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Enrolled Courses</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrollment Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Current Batch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($purchasedCourses as $payment)
                        @if($payment->course)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $payment->course->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $payment->created_at ? Carbon\Carbon::parse($payment->created_at)->format('d M Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $student_course = DB::table('course_student')
                                            ->where('user_id', $studentId)
                                            ->where('course_id', $payment->course->id)
                                            ->first();
                                        $batch = $student_course ? App\Models\Batch::find($student_course->batch_id) : null;
                                    @endphp
                                    <span class="{{ !empty($courseBatches) && $payment->course->id == $courseBatches->first()?->course_id ? 'hidden' : '' }}">
                                        {{ $batch ? $batch->batch_name : 'No Batch Assigned' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if(!empty($courseBatches) && $payment->course->id == $courseBatches->first()?->course_id)
                                        <div class="flex items-center space-x-2">
                                            <select 
                                                wire:model="selectedBatch"
                                                wire:change="assignBatch({{ $payment->course->id }}, $event.target.value)"
                                                class="mt-1 block w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="">Select Batch</option>
                                                @foreach($courseBatches as $batch)
                                                    <option value="{{ $batch->id }}"
                                                        {{ $student_course && $student_course->batch_id == $batch->id ? 'selected' : '' }}>
                                                        {{ $batch->batch_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button wire:click="$set('courseBatches', [])" class="text-gray-500 hover:text-gray-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @else
                                        <button wire:click="loadCourseBatches({{ $payment->course->id }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            {{ $batch ? 'Change Batch' : 'Select Batch' }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No enrolled courses found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif

@if($activeTab === 'payments')
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Payment History</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $payment->formatted_payment_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($payment->payment_type === 'subscription')
                                    {{ $payment->description }}
                                @else
                                    Payment for {{ $payment->course->title ?? 'Unknown Course' }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $payment->payment_type === 'subscription' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($payment->payment_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ucfirst($payment->payment_method) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                ₹{{ $payment->total_amount }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    {{ $payment->status === 'captured' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No payment history found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif

        </div>

        <!-- Enrollment Modal -->
        @if($isModalOpen)
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full"
                 style="z-index: 50;">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                    <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 sm:p-8">
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
                                    <button wire:click="enrollCourse({{ $course->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="enrollCourse"
                                        class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        <span wire:loading.remove wire:target="enrollCourse({{ $course->id }})">
                                            Enroll Now
                                        </span>
                                        <span wire:loading wire:target="enrollCourse({{ $course->id }})">
                                            Processing...
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
            </div>
        @endif
    </div>

    <style>
        /* Custom scrollbar for tables */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #cdcdcd;
        }
    </style>
</div>

@if(session()->has('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
        {{ session('error') }}
    </div>
@endif
