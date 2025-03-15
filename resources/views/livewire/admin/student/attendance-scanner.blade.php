<div class="min-h-screen bg-gradient-to-br from-teal-50 to-gray-100 py-12">
    <div class="container max-w-4xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-gray-800 text-center mb-12">
            <i class="fas fa-qrcode text-teal-600 mr-3"></i>Student Attendance Tracker
        </h2>

        <!-- Barcode Input Section -->
        <div class="bg-white p-8 rounded-2xl shadow-lg mb-8 transform transition-all hover:shadow-xl">
            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0">
                <div class="relative w-full md:w-3/4">
                    <i class="fas fa-barcode absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" wire:model="barcode" wire:keydown.enter="scanBarcode"
                        class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-teal-400 placeholder-gray-400 transition-all"
                        placeholder="Scan Student Barcode" autofocus>
                </div>
                <button wire:click="scanBarcode"
                    class="md:ml-4 w-full md:w-auto px-8 py-4 bg-teal-600 text-white rounded-xl hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all transform hover:scale-105">
                    <i class="fas fa-check-circle mr-2"></i> Scan
                </button>
            </div>
        </div>

        <!-- Message Display -->
        @if($message)
            <div class="mt-6 p-4 rounded-xl border-l-4 border-teal-500 bg-teal-50 text-teal-800 animate-fade-in">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-xl text-teal-500 mr-3"></i>
                    <p class="font-medium">{{ $message }}</p>
                </div>
            </div>
        @endif

        @if($student)
            <!-- Student Details Section -->
            <div class="mt-8 bg-white p-8 rounded-2xl shadow-lg backdrop-blur-sm bg-white/50">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user-graduate text-xl text-teal-600"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800">Student Information</h4>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-user text-teal-600 w-6"></i>
                            <span class="text-gray-600 ml-2">Name:</span>
                            <span class="ml-2 font-semibold">{{ $student->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-teal-600 w-6"></i>
                            <span class="text-gray-600 ml-2">Email:</span>
                            <span class="ml-2 font-semibold">{{ $student->email }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-barcode text-teal-600 w-6"></i>
                            <span class="text-gray-600 ml-2">Barcode:</span>
                            <span class="ml-2 font-semibold">{{ $student->barcode }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-teal-600 w-6"></i>
                            <span class="text-gray-600 ml-2">Status:</span>
                            <span class="ml-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                Present ({{ now()->format('H:i:s') }})
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Log Section -->
            <div class="mt-8 bg-white p-8 rounded-2xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-history text-xl text-teal-600"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800">Attendance Log</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm">
                                <th class="py-3 px-6 text-left rounded-tl-xl">Name</th>
                                <th class="py-3 px-6 text-left">Barcode</th>
                                <th class="py-3 px-6 text-left">Time</th>
                                <th class="py-3 px-6 text-left rounded-tr-xl">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">{{ $student->name }}</td>
                                <td class="py-4 px-6">{{ $student->barcode }}</td>
                                <td class="py-4 px-6">{{ now()->format('H:i:s') }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                        Present
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Link to Attendance Calendar -->
            <div class="mt-8 flex justify-center">
                <a wire:navigate href="{{ route('admin.student.attendance.calendar', ['studentId' => $student->id]) }}"
                    class="inline-flex items-center px-8 py-4 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    View Attendance Calendar
                </a>
            </div>
        @endif
    </div>
</div>