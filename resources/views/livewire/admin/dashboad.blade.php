      <div>
          <!-- resources/views/livewire/admin/dashboard.blade.php -->
          <div class="min-h-screen p-6">
              <div class="max-w-7xl mx-auto">
                  <!-- Header -->
                  <div class="flex justify-between items-center mb-6">
                      <h2 class="md:text-xl capitalize text-lg font-semibold text-slate-500 border-s-4 border-s-purple-600 pl-3">
                          Admin Dashboard
                      </h2>

                  </div>

                  <!-- Stats Grid -->
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                      <!-- Students -->
                      <div class="bg-white rounded-xl shadow-md p-6">
                          <div class="flex items-center justify-between">
                              <div>
                                  <p class="text-gray-600 text-sm">Total Students</p>
                                  <h2 class="text-2xl font-bold text-gray-900">{{ $studentsCount }}</h2>
                              </div>
                              <div class="p-2 bg-purple-100 rounded-full">
                                  <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 1.857h10M9 5a3 3 0 016 0 3 3 0 01-6 0zm-3 8h12" />
                                  </svg>
                              </div>
                          </div>
                      </div>

                      <!-- Courses -->
                      <div class="bg-white rounded-xl shadow-md p-6">
                          <div class="flex items-center justify-between">
                              <div>
                                  <p class="text-gray-600 text-sm">Total Courses</p>
                                  <h2 class="text-2xl font-bold text-gray-900">{{ $coursesCount }}</h2>
                              </div>
                              <div class="p-2 bg-blue-100 rounded-full">
                                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                                  </svg>
                              </div>
                          </div>
                      </div>

                      <!-- Batches -->
                      <div class="bg-white rounded-xl shadow-md p-6">
                          <div class="flex items-center justify-between">
                              <div>
                                  <p class="text-gray-600 text-sm">Total Batches</p>
                                  <h2 class="text-2xl font-bold text-gray-900">{{ $batchesCount }}</h2>
                              </div>
                              <div class="p-2 bg-yellow-100 rounded-full">
                                  <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                  </svg>
                              </div>
                          </div>
                      </div>

                      <!-- Total Payments -->
                      <div class="bg-white rounded-xl shadow-md p-6">
                          <div class="flex items-center justify-between">
                              <div>
                                  <p class="text-gray-600 text-sm">Total Payments</p>
                                  <h2 class="text-2xl font-bold text-gray-900">₹{{ number_format($paymentsCount ) }}</h2>
                              </div>
                              <div class="p-2 bg-green-100 rounded-full">
                                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Payment Details Toggle -->
                  <div class="mb-6">
                      <button
                          wire:click="togglePaymentDetails"
                          class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              @if($showPaymentDetails)
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                              @else
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542-7z" />
                              @endif
                          </svg>
                          {{ $showPaymentDetails ? 'Hide' : 'Show' }} Payment Details
                      </button>

                      @if($showPaymentDetails)
                      <div class="mt-4 bg-white rounded-xl shadow-md p-6">
                          <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h3>
                          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                              <div class="flex items-center">
                                  <!-- Calendar icon for Current Month -->
                                  <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                  </svg>
                                  <div>
                                      <p class="text-gray-600">Current Month</p>
                                      <p class="text-xl font-bold text-gray-900">₹{{ number_format($currentMonthAmount) }}</p>
                                  </div>
                              </div>
                              <div class="flex items-center">
                                  <!-- Clock icon for Previous Month -->
                                  <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                                  <div>
                                      <p class="text-gray-600">Previous Month</p>
                                      <p class="text-xl font-bold text-gray-900">₹{{ number_format($previousMonthAmount) }}</p>
                                  </div>
                              </div>
                              <div class="flex items-center">
                                  <!-- Exclamation triangle icon for Total Overdue -->
                                  <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                  </svg>
                                  <div>
                                      <p class="text-gray-600">Total Overdue</p>
                                      <p class="text-xl font-bold text-gray-900">₹{{ number_format($overdueCount) }}</p>
                                  </div>
                              </div>
                              <div class="flex items-center">
                                  <!-- Clock rewind icon for Current Month Overdue -->
                                  <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 16v.01M4 12h1m7-8a8 8 0 100 16 8 8 0 000-16z" />
                                  </svg>
                                  <div>
                                      <p class="text-gray-600">Current Month Overdue</p>
                                      <p class="text-xl font-bold text-gray-900">₹{{ number_format($currentMonthOverdue) }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      @endif
                  </div>

                  <!-- Monthly Payments Chart -->
                  <div class="bg-white rounded-xl  shadow-md p-6 mb-6">
                      <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Payments (Last 6 Months)</h3>

                      <canvas id="paymentsChart" class="w-full h-96"></canvas>

                  </div>
              </div>
              <!-- Recent Activities & Investor Management -->
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                  <div class="bg-white rounded-lg shadow-md p-6">
                      <div class="flex flex-wrap justify-between items-center ">
                          <h2 class="text-xl font-bold mb-4">Manage Course</h2>

                          <a wire:navigate href="{{ route('admin.course.manage') }}"
                              class="bg-purple-800 text-white px-3 py-1 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
                              View All
                              <i class="bi bi-arrow-down-short font-bold text-xl"></i>
                          </a>

                      </div>
                      <div class="overflow-x-auto">
                          <table class="w-full">
                              <thead>
                                  <tr class="border-b border-gray-300">
                                      <th class="text-left py-2">Name</th>
                                      <th class="text-left py-2">Duration</th>
                                      <th class="text-left py-2">Details</th>
                                  </tr>
                              </thead>
                              @foreach ($courses as $course )
                              <tbody>
                                  <tr class="border-b border-gray-300 hover:bg-gray-50 py-2">
                                      <td class="py-2">{{$course->title}}</td>
                                      <td class="py-2">{{ $course->duration }}Weeks</td>
                                      <td class="py-2  ">
                                          <a wire:navigate href="{{ route('admin.course.show', $course->id) }}"
                                              class="bg-blue-500 rounded-lg text-white px-4 py-1 ">View</a>
                                      </td>
                                  </tr>
                              </tbody>
                              @endforeach

                          </table>
                      </div>
                  </div>

                  <div class="bg-white rounded-lg shadow-md p-6">
                      <div class="flex flex-wrap justify-between items-center ">
                          <h2 class="text-xl font-bold mb-4">Manage Users</h2>

                          <a wire:navigate href="{{ route('admin.student') }}"
                              class="bg-purple-800 text-white px-3 py-1 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0 flex items-center gap-1">
                              View All
                              <i class="bi bi-arrow-down-short font-bold text-xl"></i>
                          </a>

                      </div>
                      <div class="overflow-x-auto">
                          <table class="w-full">
                              <thead class="">
                                  <tr class="border-b border-gray-300">
                                      <th class="text-left py-2">Name</th>
                                      <th class="text-left py-2">Email</th>
                                      <th class="text-left py-2">IsMember</th>
                                      <th class="text-left py-2">Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ( $users as $user)
                                  <tr class="border-b border-gray-300 hover:bg-gray-50">
                                      <td class="py-2">{{$user->name}}</td>
                                      <td class="py-2">{{$user->email}}</td>
                                      <td class="py-2"><span
                                              class="{{ $user->is_member == 1 ? 'bg-green-200 px-3 py-1 rounded-xl text-green-800' : 'bg-red-200 px-3 py-1 rounded-xl text-red-800' }}">
                                              {{ $user->is_member == 1 ? 'Yes' : 'No' }}
                                          </span></td>
                                      <td class="py-2">
                                          <a href="{{ route('admin.student.view', ['id' => $user->id]) }}"
                                              class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-500 hover:bg-blue-600">
                                              Show
                                          </a>
                                      </td>
                                  </tr>
                                  @endforeach

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>

              <!-- Notifications & Quick Links -->
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                  <div class="bg-white rounded-lg shadow-md p-6">
                      <h2 class="text-xl font-bold mb-4">Notifications</h2>
                      <div class="space-y-4">
                          @foreach ($enquiries as $enquiry )
                          <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                              <i class="fas fa-bell text-yellow-600 mr-3"></i>
                              <div>
                                  <p class="text-yellow-800">{{ $enquiry->name }}</p>
                                  <span class="text-xs text-gray-500 ml-auto">{{ $enquiry->message }}</span>
                              </div>

                          </div>
                          @endforeach


                      </div>
                  </div>

                  <div class="bg-white rounded-lg shadow-md p-6">
                      <h2 class="text-xl font-bold mb-4">Quick Links</h2>
                      <div class="grid grid-cols-2 gap-4">
                          <a href="{{route('admin.student')}}" wire:navigate class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                              <i class="fas fa-users mb-2"></i>
                              <p>View All Students</p>
                          </a>
                          <a href="{{route('admin.assignment.manage')}}" wire:navigate class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                              <i class="fas fa-plus-circle mb-2"></i>
                              <p>View Assignment</p>
                          </a>
                          <a href="{{('admin.exam')}}" wire:navigate class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                              <i class="fas fa-file-alt mb-2"></i>
                              <p>View Exams</p>
                          </a>
                          <a href="{{(route('admin.placedstudent.index'))}}" wire:navigate class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg text-center">
                              <i class="fas fa-users mb-2"></i>
                              <p>Placed Student</p>
                          </a>
                      </div>
                  </div>
              </div>
            
              <script>
                  document.addEventListener('livewire:init', () => {
                      const ctx = document.getElementById('paymentsChart').getContext('2d');
                      new Chart(ctx, {
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
                  });
              </script>

          </div>