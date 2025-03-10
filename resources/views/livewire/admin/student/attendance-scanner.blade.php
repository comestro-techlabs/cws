<div class="container min-w-full mx-auto max-w-4xl p-8 rounded-xl mt-8">
    <h2 class="text-3xl font-extrabold text-center mb-8">Student Attendance Tracker</h2>

    <!-- Barcode Input Section -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
        <div class="flex justify-center items-center">
            <input type="text" wire:model="barcode" wire:keydown.enter="scanBarcode"
                class="w-3/4 p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-400 focus:border-teal-400 placeholder-gray-500"
                placeholder="Scan Student Barcode" autofocus>
            <button wire:click="scanBarcode"
                class="ml-4 bg-teal-600 text-white p-4 rounded-lg hover:bg-teal-700 focus:outline-none transition ease-in-out duration-300">
                <i class="fas fa-check-circle"></i> Submit
            </button>
        </div>
    </div>

    <!-- Message Display -->
    @if($message)
        <div class="mt-4 p-4 bg-teal-100 border border-teal-300 text-teal-800 rounded-lg">
            <i class="fas fa-info-circle"></i> {{ $message }}
        </div>
    @endif

    <!-- Student Details Section -->
    @if($student)
        <div class="mt-8 bg-white p-6 rounded-xl shadow-lg">
            <h4 class="text-2xl font-semibold text-teal-600 mb-4">Student Information</h4>
            <div class="space-y-4">
                <p><span class="font-medium text-gray-700">Name:</span> <span class="text-teal-700">{{ $student->name }}</span></p>
                <p><span class="font-medium text-gray-700">Email:</span> <span class="text-teal-700">{{ $student->email }}</span></p>
                <p><span class="font-medium text-gray-700">Barcode:</span> <span class="text-teal-700">{{ $student->barcode }}</span></p>
                <p>
                    <span class="font-medium text-gray-700">Status:</span>
                    <span class="text-green-600 font-semibold">Present</span>
                    <span class="text-gray-600">({{ now()->format('H:i:s') }})</span>
                </p>
            </div>
        </div>

        <!-- Attendance Log Section -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow-lg">
            <h4 class="text-2xl font-semibold text-teal-600 mb-4">Attendance Log</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-xl">
                    <thead class="bg-teal-600 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Barcode</th>
                            <th class="py-3 px-6 text-left">Time</th>
                            <th class="py-3 px-6 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="py-4 px-6">{{ $student->name }}</td>
                            <td class="py-4 px-6">{{ $student->barcode }}</td>
                            <td class="py-4 px-6">{{ now()->format('H:i:s') }}</td>
                            <td class="py-4 px-6 text-green-600">Present</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Link to Attendance Calendar -->
        <div class="mt-8">
            <a href="{{ route('admin.student.attendance.calendar', ['studentId' => $student->id]) }}"
               class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition ease-in-out duration-300">
                View Attendance Calendar
            </a>
        </div>
    @endif
</div>