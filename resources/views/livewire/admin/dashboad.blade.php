<div>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Header with gradient -->
            <div class="relative mb-8 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl p-8 overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-2xl font-bold text-white mb-2">Welcome Back, Admin</h2>
                    <p class="text-purple-100">Here's what's happening with your institute today.</p>
                </div>
                <div class="absolute right-0 top-0 w-1/3 h-full opacity-10">
                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="13 2 13 9 20 9"></polyline>
                    </svg>
                </div>
            </div>

            <!-- Stats Grid with hover effects -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Enhanced stat cards with hover effects -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Students</p>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $studentsCount }}</h2>
                        </div>
                        <div class="p-2 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 1.857h10M9 5a3 3 0 016 0 3 3 0 01-6 0zm-3 8h12" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Courses</p>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $coursesCount }}</h2>
                        </div>
                        <div class="p-2 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Batches</p>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $batchesCount }}</h2>
                        </div>
                        <div class="p-2 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all p-6 border border-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Payments</p>
                            <h2 class="text-2xl font-bold text-gray-900">₹{{ number_format($paymentsCount) }}</h2>
                        </div>
                        <div class="p-2 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details Section with modern toggle -->
            <div class="mb-8">
                <button wire:click="togglePaymentDetails" class="group inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-all">
                    <span class="flex items-center">
                        <span class="w-8 h-8 flex items-center justify-center bg-blue-100 rounded-full mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($showPaymentDetails)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542-7z" />
                                @endif
                            </svg>
                        </span>
                        <span class="text-gray-700 group-hover:text-gray-900">{{ $showPaymentDetails ? 'Hide' : 'Show' }} Payment Details</span>
                    </span>
                </button>

                @if($showPaymentDetails)
                    <div class="mt-4 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <div class="flex items-center">
                            <!-- Calendar icon for Current Month -->
                            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-gray-600">Current Month</p>
                                <p class="text-xl font-bold text-gray-900">₹{{ number_format($currentMonthAmount) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <!-- Clock icon for Previous Month -->
                            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-gray-600">Previous Month</p>
                                <p class="text-xl font-bold text-gray-900">₹{{ number_format($previousMonthAmount) }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <!-- Exclamation triangle icon for Total Overdue -->
                            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="text-gray-600">Total Overdue</p>
                                <p class="text-xl font-bold text-gray-900">₹{{ number_format($overdueCount) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <!-- Clock rewind icon for Current Month Overdue -->
                            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 16v.01M4 12h1m7-8a8 8 0 100 16 8 8 0 000-16z" />
                            </svg>
                            <div>
                                <p class="text-gray-600">Current Month Overdue</p>
                                <p class="text-xl font-bold text-gray-900">₹{{ number_format($currentMonthOverdue) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Chart Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Payment Analytics</h3>
                    <div class="flex gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Captured
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Overdue
                        </span>
                    </div>
                </div>
                <div class="h-72"> <!-- Changed from h-96 to h-72 -->
                    <canvas id="paymentsChart"></canvas>
                </div>
            </div>

            <!-- Tables Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Courses Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Recent Courses</h2>
                            <a wire:navigate href="{{ route('admin.course.manage') }}"
                               class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 transition-colors">
                                <span class="mr-1">View All</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($courses as $course)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-900">{{$course->title}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-500">{{ $course->duration }} Weeks</td>
                                        <td class="px-4 py-3 text-right">
                                            <a wire:navigate href="{{ route('admin.course.show', $course->id) }}"
                                               class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium text-white bg-blue-500 hover:bg-blue-600 transition-colors">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Manage Users</h2>
                            <a wire:navigate href="{{ route('admin.student') }}"
                               class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 transition-colors">
                                <span class="mr-1">View All</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-900">{{$user->name}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-500">{{$user->email}}</td>
                                        <td class="px-4 py-3">
                                            <span class="{{ $user->is_member == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                                                {{ $user->is_member == 1 ? 'Member' : 'Non-member' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('admin.student.view', ['id' => $user->id]) }}"
                                               class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium text-white bg-blue-500 hover:bg-blue-600 transition-colors">
                                                View Profile
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Notifications and Quick Links -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Notifications -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Notifications</h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach ($enquiries as $enquiry)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start">
                                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full">
                                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    </span>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $enquiry->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $enquiry->message }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Quick Links</h2>
                    </div>
                    <div class="grid grid-cols-2 gap-4 p-6">
                        <a href="{{route('admin.student')}}" wire:navigate
                            class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                            <i class="fas fa-users mb-2"></i>
                            <p>View All Students</p>
                        </a>
                        <a href="{{route('admin.assignment.manage')}}" wire:navigate
                            class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                            <i class="fas fa-plus-circle mb-2"></i>
                            <p>View Assignment</p>
                        </a>
                        <a href="{{('admin.exam')}}" wire:navigate
                            class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                            <i class="fas fa-file-alt mb-2"></i>
                            <p>View Exams</p>
                        </a>
                        <a href="{{(route('admin.placedstudent.index'))}}" wire:navigate
                            class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                            <i class="fas fa-users mb-2"></i>
                            <p>Placed Student</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let myChart;

            document.addEventListener('DOMContentLoaded', () => {
                initializeChart();
            });

            document.addEventListener('livewire:navigated', () => {
                setTimeout(() => {
                    initializeChart();
                }, 100);
            });

            function initializeChart() {
                const ctx = document.getElementById('paymentsChart')?.getContext('2d');
                if (!ctx) {
                    console.log('Canvas #paymentsChart not found');
                    return;
                }

                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($monthlyPaymentsLabels),
                        datasets: [{
                            label: 'Captured Payments',
                            data: @json($monthlyCapturedValues),
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Overdue Payments',
                            data: @json($monthlyOverdueValues),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '₹' + (value / 100).toLocaleString('en-IN');
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += '₹' + (context.parsed.y / 100).toLocaleString('en-IN');
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        </script>
    </div>
</div>
