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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                eventDisplay: 'block',
                hiddenDays: [0, 6],
            });
            calendar.render();
        });
    </script>
</div>