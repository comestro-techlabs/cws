<div class="min-h-screen bg-gradient-to-br from-teal-50 to-gray-100 py-6">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-qrcode text-teal-600 mr-3"></i>
                <span>Attendance Scanner</span>
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-500">
                    <i class="fas fa-clock mr-2"></i>{{ now()->format('h:i A') }}
                </span>
                <span class="text-gray-500">
                    <i class="fas fa-calendar mr-2"></i>{{ now()->format('d M, Y') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Scanner and Filters -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Scanner Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Scan Attendance</h3>
                        <div class="relative">
                            <i class="fas fa-barcode absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" wire:model="barcode" wire:keydown.enter="scanBarcode"
                                class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 placeholder-gray-400 transition-all"
                                placeholder="Scan Student Barcode" autofocus>
                        </div>
                        <button wire:click="scanBarcode"
                            class="mt-4 w-full px-6 py-3 bg-teal-600 text-white rounded-xl hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all transform hover:scale-105">
                            <i class="fas fa-check-circle mr-2"></i> Mark Attendance
                        </button>
                    </div>

                    <!-- Filter Section -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-700">Filter Students</h4>
                        <div class="space-y-3">
                            <select wire:model.live="selectedCourse"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400">
                                <option value="">All Courses</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            <select wire:model.live="selectedBatch"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400">
                                <option value="">All Batches</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Today's Overview</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                            <div>
                                <p class="text-sm text-green-600">Present</p>
                                <p class="text-2xl font-bold text-green-700">{{ $todayStats['present'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-xl text-green-600"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl">
                            <div>
                                <p class="text-sm text-red-600">Absent</p>
                                <p class="text-2xl font-bold text-red-700">{{ $todayStats['absent'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-times text-xl text-red-600"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                            <div>
                                <p class="text-sm text-blue-600">Total</p>
                                <p class="text-2xl font-bold text-blue-700">{{ $todayStats['total'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Attendance Log and Student Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Message Display -->
                @if($message)
                    <div class="p-4 rounded-xl border-l-4 border-teal-500 bg-teal-50 text-teal-800 animate-fade-in">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-xl text-teal-500 mr-3"></i>
                            <p class="font-medium">{{ $message }}</p>
                        </div>
                    </div>
                @endif

                <!-- Student Details Card (if scanned) -->
                @if($student)
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-user-graduate text-2xl text-teal-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-bold text-gray-800">{{ $student->name }}</h4>
                                    <p class="text-gray-500">{{ $student->course->name }} - {{ $student->batch->name }}</p>
                                </div>
                            </div>
                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                Just Marked Present
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-6 border-t border-gray-100 pt-6">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-teal-600 w-6"></i>
                                    <span class="ml-2 text-gray-600">{{ $student->email }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-teal-600 w-6"></i>
                                    <span class="ml-2 text-gray-600">{{ $student->phone ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i class="fas fa-barcode text-teal-600 w-6"></i>
                                    <span class="ml-2 text-gray-600">{{ $student->barcode }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-teal-600 w-6"></i>
                                    <span class="ml-2 text-gray-600">{{ now()->format('h:i:s A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Recent Attendance Log -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Recent Attendance Log</h3>
                        <button wire:click="refreshAttendance" class="text-teal-600 hover:text-teal-700">
                            <i class="fas fa-sync-alt mr-2"></i> Refresh
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 text-sm">
                                    <th class="py-3 px-4 text-left">Time</th>
                                    <th class="py-3 px-4 text-left">Student</th>
                                    <th class="py-3 px-4 text-left">Course</th>
                                    <th class="py-3 px-4 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayAttendance as $record)
                                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="py-3 px-4 text-gray-600">{{ $record->created_at->format('h:i A') }}</td>
                                        <td class="py-3 px-4">
                                            <div class="font-medium text-gray-800">{{ $record->student->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $record->student->batch->name }}</div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">{{ $record->student->course->name }}</td>
                                        <td class="py-3 px-4">
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                                Present
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-4"></i>
                                            <p>No attendance records for today</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>