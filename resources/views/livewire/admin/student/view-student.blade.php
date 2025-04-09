<div>
    <div class="min-h-screen bg-gray-50 py-8">
        <x-loader /> <!-- Add loader component -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
           

            <!-- Student Details Grid with Inline Editing for Education -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach([['label' => 'Name', 'value' => $student->name, 'editable' => true, 'field' => 'name'], ['label' => 'Email', 'value' => $student->email, 'editable' => true, 'field' => 'email'], ['label' => 'Contact', 'value' => $student->contact, 'editable' => true, 'field' => 'contact'], ['label' => 'Gender', 'value' => $student->gender, 'editable' => true, 'field' => 'gender'], ['label' => 'Education', 'value' => $student->education_qualification, 'editable' => true, 'field' => 'education_qualification'], ['label' => 'Date of Birth', 'value' => $student->dob, 'editable' => true, 'field' => 'dob'], ['label' => 'Registration Date', 'value' => $student->created_at->format('d M Y')], ['label' => 'Account Status', 'value' => $student->is_active ? 'Active' : 'Inactive'],
                    ['label' => 'Student ID', 'value' => 'STU' . str_pad($student->id, 5, '0', STR_PAD_LEFT)],
                    ['label' => 'Barcode', 'value' => $student->barcode ?? 'Not Generated'],
                    ['label' => 'Barcode Scan', 'value' => null, 'is_image' => true]
                ] as $detail)
                                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-200">
                                        <div class="text-sm font-medium text-gray-500">{{ $detail['label'] }}</div>
                                        <div class="mt-1 text-lg font-semibold text-gray-900">
                                            @if(isset($detail['is_image']) && $detail['is_image'])
                                                @if($barcodeImage)
                                                    <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Student Barcode" class="max-w-[200px] mx-auto">
                                                @endif
                                            @elseif(isset($detail['editable']) && $detail['editable'] && $editingField === $detail['field'])
                                                <div>
                                                    @if($detail['field'] === 'gender')
                                                        <select 
                                                            wire:model.live.debounce.500ms="{{ $detail['field'] }}"
                                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error($detail['field']) border-red-500 @enderror"
                                                        >
                                                            <option value="">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    @elseif($detail['field'] === 'dob')
                                                        <input 
                                                            type="date" 
                                                            wire:model.live.debounce.500ms="{{ $detail['field'] }}"
                                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error($detail['field']) border-red-500 @enderror"
                                                        >
                                                    @else
                                                        <textarea 
                                                            wire:model.live.debounce.500ms="{{ $detail['field'] }}"
                                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error($detail['field']) border-red-500 @enderror"
                                                            placeholder="Enter {{ $detail['label'] }}"
                                                            rows="2"
                                                        ></textarea>
                                                    @endif
                                                    @error($detail['field'])
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                    <div class="mt-2 flex space-x-2">
                                                        <button 
                                                            wire:click="saveField('{{ $detail['field'] }}')"
                                                            wire:loading.attr="disabled"
                                                            class="bg-blue-600 text-white text-sm px-3 py-1 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none disabled:opacity-50 transition-all"
                                                        >
                                                            <span wire:loading.remove>Save</span>
                                                            <span wire:loading>Saving...</span>
                                                        </button>
                                                        <button 
                                                            wire:click="cancelEdit"
                                                            class="bg-gray-500 text-white text-sm px-3 py-1 rounded-md hover:bg-gray-600 focus:ring-2 focus:ring-gray-400 focus:outline-none transition-all"
                                                        >Cancel</button>
                                                    </div>
                                                </div>
                                            @elseif(isset($detail['editable']) && $detail['editable'])
                                                <div class="flex items-center justify-between">
                                                    <span>{{ $detail['value'] ?? 'Not specified' }}</span>
                                                    <button 
                                                        wire:click="editField('{{ $detail['field'] }}')"
                                                        ><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg></button>
                                                </div>
                                            @else
                                                {{ $detail['value'] ?? 'N/A' }}
                                            @endif
                                        </div>
                                    </div>
                @endforeach
            </div>

            <button wire:click="generateBarcode({{ $studentId }})"
                class="bg-blue-600 text-white py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:outline-none {{ !$this->hasActiveBatch() ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105' }}"
                @if(!$this->hasActiveBatch()) disabled @endif>
                Generate Barcode
            </button>

            @if ($showBarcodeModal)
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                    <div class="bg-white p-8 rounded-lg shadow-xl w-full sm:w-96 max-w-md">
                        <div class="text-center">
                            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Generated Barcode</h2>
                            <div class="mb-6">
                                <p class="text-xl text-gray-800 font-medium">{{ $student->name }}</p>
                                <p class="text-lg text-gray-600 mt-2">{{ $barcode }}</p>
                            </div>
                            <button wire:click="closeBarcodeModal"
                                class="bg-red-600 text-white py-3 px-6 rounded-lg hover:bg-red-700 transition duration-300 ease-in-out transform">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modified Tabs Navigation -->
            <div class="mb-8 border-b border-gray-200">
                <nav class="-mb-px flex flex-col sm:flex-row sm:space-x-8" aria-label="Tabs">
                    @foreach(['courses' => 'Courses', 'subscription' => 'Subscription Plan', 'enrolled' => 'Enrolled Courses', 'payments' => 'Payment History'] as $tab => $label)
                                                                    <button wire:click="setActiveTab('{{ $tab }}')" class="whitespace-nowrap py-4 px-1 sm:px-4 border-b-2 font-medium text-sm transition-colors w-full sm:w-auto text-left
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
                    <div class="p-4 sm:p-6">
                        <!-- Header with Button -->
                        <div
                            class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 space-y-3 sm:space-y-0">
                            <h2 class="text-base sm:text-lg font-semibold text-gray-900">Purchased Courses</h2>
                            <button wire:click="enrollButtonOpenModal"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-3 sm:px-4 py-2 bg-blue-600 text-white text-xs sm:text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 sm:w-5 h-4 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Enroll in New Course
                            </button>
                        </div>

                        <!-- Table Section -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 text-xs sm:text-sm">
                                <thead class="bg-gray-200 text-center">
                                    <tr>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Course</th>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Order Id</th>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Payment Status</th>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Method</th>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Amount</th>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Date</th>
                                        <th class="p-2 sm:p-3 font-medium text-gray-600 border">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($purchasedCourses as $payment)
                                        <tr class="text-center">
                                            <td class="px-2 sm:px-4 py-2 border break-words">
                                                {{ $payment->course->title ?? 'Unknown Course' }}
                                            </td>
                                            <td class="px-2 sm:px-4 py-2 border break-all">{{ $payment->order_id }}</td>
                                            <td class="px-2 sm:px-4 py-2 border text-green-500">{{ $payment->status }}</td>
                                            <td class="px-2 sm:px-4 py-2 border">{{ $payment->payment_method }}</td>
                                            <td class="px-2 sm:px-4 py-2 border">{{ $payment->total_amount }}</td>
                                            <td class="px-2 sm:px-4 py-2 border">
                                                {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : 'N/A' }}
                                            </td>
                                            <td class="flex gap-4 px-2 sm:px-4 py-2 border">
                                                <button wire:click="openModal({{ $payment->id }})"
                                                    class="text-gray-600 hover:text-gray-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button wire:click="deletePayment({{ $payment->id }})"
                                                    class="text-gray-600 hover:text-gray-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25"
                                                        height="25" viewBox="0 0 100 100">
                                                        <path fill="#f37e98"
                                                            d="M25,30l3.645,47.383C28.845,79.988,31.017,82,33.63,82h32.74c2.613,0,4.785-2.012,4.985-4.617L75,30">
                                                        </path>
                                                        <path fill="#f15b6c"
                                                            d="M65 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S65 36.35 65 38zM53 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S53 36.35 53 38zM41 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S41 36.35 41 38zM77 24h-4l-1.835-3.058C70.442 19.737 69.14 19 67.735 19h-35.47c-1.405 0-2.707.737-3.43 1.942L27 24h-4c-1.657 0-3 1.343-3 3s1.343 3 3 3h54c1.657 0 3-1.343 3-3S78.657 24 77 24z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M66.37 83H33.63c-3.116 0-5.744-2.434-5.982-5.54l-3.645-47.383 1.994-.154 3.645 47.384C29.801 79.378 31.553 81 33.63 81H66.37c2.077 0 3.829-1.622 3.988-3.692l3.645-47.385 1.994.154-3.645 47.384C72.113 80.566 69.485 83 66.37 83zM56 20c-.552 0-1-.447-1-1v-3c0-.552-.449-1-1-1h-8c-.551 0-1 .448-1 1v3c0 .553-.448 1-1 1s-1-.447-1-1v-3c0-1.654 1.346-3 3-3h8c1.654 0 3 1.346 3 3v3C57 19.553 56.552 20 56 20z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M77,31H23c-2.206,0-4-1.794-4-4s1.794-4,4-4h3.434l1.543-2.572C28.875,18.931,30.518,18,32.265,18h35.471c1.747,0,3.389,0.931,4.287,2.428L73.566,23H77c2.206,0,4,1.794,4,4S79.206,31,77,31z M23,25c-1.103,0-2,0.897-2,2s0.897,2,2,2h54c1.103,0,2-0.897,2-2s-0.897-2-2-2h-4c-0.351,0-0.677-0.185-0.857-0.485l-1.835-3.058C69.769,20.559,68.783,20,67.735,20H32.265c-1.048,0-2.033,0.559-2.572,1.457l-1.835,3.058C27.677,24.815,27.351,25,27,25H23z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M61.5 25h-36c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h36c.276 0 .5.224.5.5S61.776 25 61.5 25zM73.5 25h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5S73.776 25 73.5 25zM66.5 25h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.276 0 .5.224.5.5S66.776 25 66.5 25zM50 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v25.5c0 .276-.224.5-.5.5S52 63.776 52 63.5V38c0-1.103-.897-2-2-2s-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2v-3.5c0-.276.224-.5.5-.5s.5.224.5.5V73C53 74.654 51.654 76 50 76zM62 76c-1.654 0-3-1.346-3-3V47.5c0-.276.224-.5.5-.5s.5.224.5.5V73c0 1.103.897 2 2 2s2-.897 2-2V38c0-1.103-.897-2-2-2s-2 .897-2 2v1.5c0 .276-.224.5-.5.5S59 39.776 59 39.5V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C65 74.654 63.654 76 62 76z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M59.5 45c-.276 0-.5-.224-.5-.5v-2c0-.276.224-.5.5-.5s.5.224.5.5v2C60 44.776 59.776 45 59.5 45zM38 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C41 74.654 39.654 76 38 76zM38 36c-1.103 0-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2V38C40 36.897 39.103 36 38 36z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-2 sm:px-4 py-2 text-center">No courses purchased.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Subscription Tab -->
                @if($activeTab === 'subscription')
                                                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                                                        @if($activeSubscription)
                                                            <div class="mb-8">
                                                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                                                    <div class="flex justify-between items-center">
                                                                        <h3 class="text-lg font-semibold text-green-800">Current Active Subscription</h3>
                                                                        <button wire:click="openEditSubscriptionModal({{ $activeSubscription->id }})"
                                                                            class="text-purple-600 hover:underline">
                                                                            Edit
                                                                        </button>
                                                                    </div>
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

                                                        @if($isEditSubscriptionModalOpen)
                                                            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                                                                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                                                                    <h3 class="text-lg font-semibold mb-4">Edit Subscription</h3>
                                                                    <form wire:submit.prevent="saveEditedSubscription">
                                                                        <div class="mb-4">
                                                                            <label class="block text-sm font-medium text-gray-700">Plan</label>
                                                                            <select wire:model="editPlanId"
                                                                                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm">
                                                                                @foreach($subscriptionPlans as $plan)
                                                                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('editPlanId') <span class="text-red-500 text-sm">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label class="block text-sm font-medium text-gray-700">Valid Until</label>
                                                                            <input type="date" wire:model="editEndsAt"
                                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                                                            @error('editEndsAt') <span class="text-red-500 text-sm">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                                                            <select wire:model="editStatus"
                                                                                class="mt-1 block w-full p-3 rounded-md border-gray-300 shadow-sm">
                                                                                <option value="active">Active</option>
                                                                                <option value="inactive">Inactive</option>
                                                                                <option value="cancelled">Cancelled</option>
                                                                            </select>
                                                                            @error('editStatus') <span class="text-red-500 text-sm">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="flex justify-end space-x-2">
                                                                            <button type="button" wire:click="closeEditSubscriptionModal"
                                                                                class="bg-gray-300 text-gray-700 rounded-md py-2 px-4 hover:bg-gray-400">
                                                                                Cancel
                                                                            </button>
                                                                            <button type="submit"
                                                                                class="bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700">
                                                                                Save
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="text-center">
                                                            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Subscription Plans</h2>
                                                            <p class="mt-4 text-lg text-gray-500">Choose the perfect plan for your learning journey</p>
                                                        </div>

                                                        <div class="mt-12 grid gap-8 lg:grid-cols-3">
                                                            @foreach($subscriptionPlans as $plan)
                                                                                                                                                            <div
                                                                                                                                                                class="bg-white rounded-lg shadow-lg overflow-hidden {{ $plan->slug === 'pro' ? 'border-2 border-purple-500' : '' }}">
                                                                                                                                                                <div class="px-6 py-8">
                                                                                                                                                                    <h3 class="text-2xl font-bold text-purple-600">{{ $plan->name }}</h3>
                                                                                                                                                                    <p class="mt-4 text-gray-500">{{ $plan->description }}</p>
                                                                                                                                                                    <p class="mt-8">
                                                                                                                                                                        <span class="text-4xl font-bold text-gray-900">₹{{ $plan->price }}</span>
                                                                                                                                                                        <span class="text-gray-500">/{{ $plan->duration_in_days }} days</span>
                                                                                                                                                                    </p>
                                                                                                                                                                    <button wire:click="subscribePlan({{ $plan->id }})" wire:loading.attr="disabled"
                                                                                                                                                                        wire:target="subscribePlan({{ $plan->id }})" @if($activeSubscription) disabled
                                                                                                                                                                        @endif
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
                                                                                                                                                                                <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor"
                                                                                                                                                                                    viewBox="0 0 20 20">
                                                                                                                                                                                    <path fill-rule="evenodd"
                                                                                                                                                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                                                                                                                                        clip-rule="evenodd" />
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

                <!-- Enrolled Courses Tab -->
                @if($activeTab === 'enrolled')
                                        <div class="p-6">
                                            <h3 class="text-lg font-semibold mb-4">Enrolled Courses</h3>
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full bg-white border border-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course
                                                            </th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                                Enrollment Date</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Current
                                                                Batch</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions
                                                            </th>
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
                                                                                                                                                                                                                                                                                                                                                <span
                                                                                                                                                                                                                                                                                                                                                    class="{{ !empty($courseBatches) && $payment->course->id == $courseBatches->first()?->course_id ? 'hidden' : '' }}">
                                                                                                                                                                                                                                                                                                                                                    {{ $batch ? $batch->batch_name : 'No Batch Assigned' }}
                                                                                                                                                                                                                                                                                                                                                </span>
                                                                                                                                                                                                                                                                                                                                            </td>
                                                                                                                                                                                                                                                                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                                                                                                                                                                                                                                                                                                                @if(!empty($courseBatches) && $payment->course->id == $courseBatches->first()?->course_id)
                                                                                                                                                                                                                                                                                                                                                    <div class="flex items-center space-x-2">
                                                                                                                                                                                                                                                                                                                                                        <select wire:model="selectedBatch"
                                                                                                                                                                                                                                                                                                                                                            wire:change="assignBatch({{ $payment->course->id }}, $event.target.value)"
                                                                                                                                                                                                                                                                                                                                                            class="mt-1 block w-64 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                                                                                                                                                                                                                                                                                                            <option value="">Select Batch</option>
                                                                                                                                                                                                                                                                                                                                                            @foreach($courseBatches as $batch)
                                                                                                                                                                                                                                                                                                                                                                <option value="{{ $batch->id }}" {{ $student_course && $student_course->batch_id == $batch->id ? 'selected' : '' }}>
                                                                                                                                                                                                                                                                                                                                                                    {{ $batch->batch_name }}
                                                                                                                                                                                                                                                                                                                                                                </option>
                                                                                                                                                                                                                                                                                                                                                            @endforeach
                                                                                                                                                                                                                                                                                                                                                        </select>
                                                                                                                                                                                                                                                                                                                                                        <button wire:click="$set('courseBatches', [])"
                                                                                                                                                                                                                                                                                                                                                            class="text-gray-500 hover:text-gray-700">
                                                                                                                                                                                                                                                                                                                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                                                                                                                                                                                                                                                                                                                viewBox="0 0 24 24">
                                                                                                                                                                                                                                                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                                                                                                                                                                                                                                                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
                                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No enrolled courses
                                                                    found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                @endif

                <!-- Payments Tab -->
                @if($activeTab === 'payments')
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Payment History</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Type</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Method</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
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
                                                <span
                                                    class="px-2 py-1 text-xs font-medium rounded-full
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
                                                <span
                                                    class="px-2 py-1 text-xs font-medium rounded-full
                                                                    {{ $payment->status === 'captured' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <button wire:click="deletePaymentHistory({{ $payment->id }})"
                                                    class="text-gray-600 hover:text-gray-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25"
                                                        height="25" viewBox="0 0 100 100">
                                                        <path fill="#f37e98"
                                                            d="M25,30l3.645,47.383C28.845,79.988,31.017,82,33.63,82h32.74c2.613,0,4.785-2.012,4.985-4.617L75,30">
                                                        </path>
                                                        <path fill="#f15b6c"
                                                            d="M65 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S65 36.35 65 38zM53 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S53 36.35 53 38zM41 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S41 36.35 41 38zM77 24h-4l-1.835-3.058C70.442 19.737 69.14 19 67.735 19h-35.47c-1.405 0-2.707.737-3.43 1.942L27 24h-4c-1.657 0-3 1.343-3 3s1.343 3 3 3h54c1.657 0 3-1.343 3-3S78.657 24 77 24z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M66.37 83H33.63c-3.116 0-5.744-2.434-5.982-5.54l-3.645-47.383 1.994-.154 3.645 47.384C29.801 79.378 31.553 81 33.63 81H66.37c2.077 0 3.829-1.622 3.988-3.692l3.645-47.385 1.994.154-3.645 47.384C72.113 80.566 69.485 83 66.37 83zM56 20c-.552 0-1-.447-1-1v-3c0-.552-.449-1-1-1h-8c-.551 0-1 .448-1 1v3c0 .553-.448 1-1 1s-1-.447-1-1v-3c0-1.654 1.346-3 3-3h8c1.654 0 3 1.346 3 3v3C57 19.553 56.552 20 56 20z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M77,31H23c-2.206,0-4-1.794-4-4s1.794-4,4-4h3.434l1.543-2.572C28.875,18.931,30.518,18,32.265,18h35.471c1.747,0,3.389,0.931,4.287,2.428L73.566,23H77c2.206,0,4,1.794,4,4S79.206,31,77,31z M23,25c-1.103,0-2,0.897-2,2s0.897,2,2,2h54c1.103,0,2-0.897,2-2s-0.897-2-2-2h-4c-0.351,0-0.677-0.185-0.857-0.485l-1.835-3.058C69.769,20.559,68.783,20,67.735,20H32.265c-1.048,0-2.033,0.559-2.572,1.457l-1.835,3.058C27.677,24.815,27.351,25,27,25H23z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M61.5 25h-36c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h36c.276 0 .5.224.5.5S61.776 25 61.5 25zM73.5 25h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5S73.776 25 73.5 25zM66.5 25h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.276 0 .5.224.5.5S66.776 25 66.5 25zM50 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v25.5c0 .276-.224.5-.5.5S52 63.776 52 63.5V38c0-1.103-.897-2-2-2s-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2v-3.5c0-.276.224-.5.5-.5s.5.224.5.5V73C53 74.654 51.654 76 50 76zM62 76c-1.654 0-3-1.346-3-3V47.5c0-.276.224-.5.5-.5s.5.224.5.5V73c0 1.103.897 2 2 2s2-.897 2-2V38c0-1.103-.897-2-2-2s-2 .897-2 2v1.5c0 .276-.224.5-.5.5S59 39.776 59 39.5V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C65 74.654 63.654 76 62 76z">
                                                        </path>
                                                        <path fill="#1f212b"
                                                            d="M59.5 45c-.276 0-.5-.224-.5-.5v-2c0-.276.224-.5.5-.5s.5.224.5.5v2C60 44.776 59.776 45 59.5 45zM38 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C41 74.654 39.654 76 38 76zM38 36c-1.103 0-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2V38C40 36.897 39.103 36 38 36z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No payment history found
                                            </td>
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
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto h-full w-full" style="z-index: 50;">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                        <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 sm:p-8">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-semibold text-gray-800">Enroll in New Course</h2>
                                <button wire:click="enrollButtonCloseModal"
                                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="flex space-x-4 mb-6">
                                <div class="flex-1 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model.live.debounce.300ms="searchTerm"
                                        placeholder="Search courses..."
                                        class="w-full pl-10 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                </div>

                                <select wire:model.live="courseFilter"
                                    class="bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="all">All Courses</option>
                                    @foreach($allCourses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="max-h-64 overflow-y-auto pr-1 mb-6">
                                <ul class="space-y-3">
                                    @forelse($availableCourses as $course)
                                        <li
                                            class="p-4 bg-white border border-gray-100 rounded-xl hover:shadow-md hover:border-blue-100 transition-all duration-200 flex flex-wrap md:flex-nowrap justify-between items-center gap-3">
                                            <div class="flex-grow">
                                                <h3 class="text-gray-800 font-semibold">{{ $course->title }}</h3>
                                                <div class="mt-1 flex items-center">
                                                    <span
                                                        class="bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 font-medium px-3 py-1 rounded-lg flex items-center">
                                                        ₹ {{ $course->discounted_fees }}
                                                    </span>
                                                </div>
                                            </div>
                                            <button wire:click="openModalForEnrollment({{ $course->id }})"
                                                wire:loading.attr="disabled"
                                                class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                <span wire:loading.remove
                                                    wire:target="openModalForEnrollment({{ $course->id }})">
                                                    Enroll Now
                                                </span>
                                                <span wire:loading wire:target="openModalForEnrollment({{ $course->id }})">
                                                    Processing...
                                                </span>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="p-6 text-center text-gray-500">
                                            @if($searchTerm)
                                                No courses found matching "{{ $searchTerm }}"
                                            @else
                                                No courses available.
                                            @endif
                                        </li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="flex justify-end">
                                <button wire:click="enrollButtonCloseModal"
                                    class="text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium py-2.5 px-5 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($showModal)
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50">
                    <div class="fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all w-full max-w-lg sm:max-w-2xl mx-4 sm:mx-auto">
                                <form wire:submit.prevent="saveEnrollment" class="p-4 sm:p-6">
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Amount</label>
                                        <input type="number" wire:model="total_amount" class="w-full p-2 border rounded">
                                        @error('total_amount') <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="submit"
                                            class="inline-flex w-full justify-center rounded-md bg-teal-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 sm:ml-3 sm:w-auto">
                                            Enroll Now
                                        </button>
                                        <button type="button" wire:click="closeModal"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <style>
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

    <!-- Notifications -->
    @if(session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>