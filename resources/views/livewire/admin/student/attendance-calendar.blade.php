<div>
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h4 class="text-2xl font-semibold text-teal-600 mb-4">Attendance Calendar</h4>

        <!-- Display Present and Absent Counts -->
        <div class="mb-6">
            <p class="text-lg text-gray-700">
                <span class="font-medium">Present Days:</span>
                <span class="text-green-600">{{ $presentCount }}</span>
            </p>
            <p class="text-lg text-gray-700">
                <span class="font-medium">Absent Days:</span>
                <span class="text-red-600">{{ $absentCount }}</span>
            </p>
        </div>

        <!-- Calendar -->
        <div id="calendar" wire:ignore></div>
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <script>
        // Function to initialize the calendar
        function initializeCalendar() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) return; // Exit if the calendar element isn't found

            // Destroy any existing calendar instance (optional, FullCalendar v6 manages this)
            if (calendarEl._fullCalendar) {
                calendarEl._fullCalendar.destroy();
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events), // Events passed from Laravel backend
                eventDisplay: 'block',
                hiddenDays: [0, 6], 
            });
            calendar.render();

            calendarEl._fullCalendar = calendar;
        }

        document.addEventListener('DOMContentLoaded', function () {
            initializeCalendar();
        });

        document.addEventListener('calendar:reinitialize', function () {
            initializeCalendar();
        });

        document.addEventListener('livewire:navigated', function () {
            document.dispatchEvent(new CustomEvent('calendar:reinitialize'));
        });

        document.addEventListener('livewire:init', function () {
            document.dispatchEvent(new CustomEvent('calendar:reinitialize'));
        });
    </script>
</div>