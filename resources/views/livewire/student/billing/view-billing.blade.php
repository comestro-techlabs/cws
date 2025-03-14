<div x-data="{ activeTab: 'all' }" class="bg-gray-50 min-h-screen pt-6 mt-5 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Total Spent Card -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-sm font-medium text-gray-500">Total Spent</h3>
                <p class="text-2xl font-bold text-gray-900">₹{{ $paymentsWithWorkshops->where('status', 'captured')->sum('total_amount') }}</p>
            </div>
            <!-- Active Subscription Card -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-sm font-medium text-gray-500">Subscription Status</h3>
                <p class="text-lg font-semibold {{ auth()->user()->hasActiveSubscription() ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ auth()->user()->hasActiveSubscription() ? 'Active' : 'No Active Subscription' }}
                </p>
                @if(auth()->user()->hasActiveSubscription())
                    <p class="text-sm text-gray-500">Expires: {{ auth()->user()->currentSubscription?->ends_at?->format('M d, Y') }}</p>
                @endif
            </div>
            <!-- Pending Payments Card -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-sm font-medium text-gray-500">Pending Payments</h3>
                <p class="text-2xl font-bold {{ $overdueCount > 0 ? 'text-red-600' : 'text-gray-900' }}">
                    {{ $paymentsWithWorkshops->whereIn('status', ['unpaid', 'overdue'])->count() }}
                </p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button @click="activeTab = 'all'" 
                            :class="{ 'border-purple-500 text-purple-600': activeTab === 'all', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'all' }" 
                            class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        All Transactions
                    </button>
                    <button @click="activeTab = 'courses'" 
                            :class="{ 'border-purple-500 text-purple-600': activeTab === 'courses', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'courses' }" 
                            class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Course Payments
                    </button>
                    <button @click="activeTab = 'subscription'" 
                            :class="{ 'border-purple-500 text-purple-600': activeTab === 'subscription', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'subscription' }" 
                            class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Subscription Payments
                    </button>
                    <button @click="activeTab = 'workshops'" 
                            :class="{ 'border-purple-500 text-purple-600': activeTab === 'workshops', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'workshops' }" 
                            class="w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm">
                        Workshop Payments
                    </button>
                </nav>
            </div>
        </div>

        <!-- Payment Records -->
        <div class="space-y-4">
            <!-- All Transactions -->
            <div x-show="activeTab === 'all'">
                @foreach ($paymentsWithWorkshops->sortByDesc('created_at') as $payment)
                    @include('components.payment-record-card', ['payment' => $payment])
                @endforeach
            </div>

            <!-- Course Payments -->
            <div x-show="activeTab === 'courses'">
                @foreach ($paymentsWithWorkshops->where('course_id', '!=', null)->sortByDesc('created_at') as $payment)
                    @include('components.payment-record-card', ['payment' => $payment])
                @endforeach
            </div>

            <!-- Subscription Payments -->
            <div x-show="activeTab === 'subscription'">
                @foreach ($paymentsWithWorkshops->whereNull('course_id')->whereNull('workshop_id')->sortByDesc('created_at') as $payment)
                    @include('components.payment-record-card', ['payment' => $payment])
                @endforeach
            </div>

            <!-- Workshop Payments -->
            <div x-show="activeTab === 'workshops'">
                @foreach ($paymentsWithWorkshops->where('workshop_id', '!=', null)->sortByDesc('created_at') as $payment)
                    @include('components.payment-record-card', ['payment' => $payment])
                @endforeach
            </div>
        </div>
    </div>
</div>
