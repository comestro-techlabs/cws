<div class="p-8 rounded-2xl shadow-lg">
    <h4 class="text-3xl font-bold text-teal-700 mb-6">Attendance Calendar</h4>

    <!-- Display Present and Absent Counts -->
    <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
        <p class="text-lg text-gray-700 mb-3">
            <span class="font-medium">Present Days:</span>
            <span class="text-green-600 font-semibold">{{ $presentCount }}</span>
        </p>
        <p class="text-lg text-gray-700 mb-3">
            <span class="font-medium">Absent Days:</span>
            <span class="text-red-600 font-semibold">{{ $absentCount }}</span>
        </p>
        <p class="text-lg text-gray-700">
            <span class="font-medium">Today’s Status ({{ \Carbon\Carbon::today()->toDateString() }}):</span>
            @if($todayStatus === 'Present')
                <span class="text-green-600 font-semibold">Present</span>
            @elseif($todayStatus === 'Absent')
                <span class="text-red-600 font-semibold">Absent</span>
            @else
                <span class="text-gray-500 font-semibold">Not Recorded</span>
            @endif
        </p>
    </div>

    <!-- Calendar -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div id="calendar" wire:ignore></div>
    </div>
</div>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js" onerror="console.error('Failed to load FullCalendar from CDN')"></script>

<script>
    document.addEventListener('livewire:navigated', () => {
        console.log('livewire:navigated');
        initializeCalendar();
    });

    function initializeCalendar() {
        var calendarEl = document.getElementById('calendar');
        if (!calendarEl || typeof FullCalendar === 'undefined') {
            console.error('Calendar element or FullCalendar not ready yet.');
            setTimeout(initializeCalendar, 50); // Retry after 50ms
            return;
        }

        // Destroy any existing calendar instance to avoid duplicates
        if (calendarEl.fullCalendar) {
            calendarEl.fullCalendar.destroy();
        }

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events),
            eventDisplay: 'block',
            hiddenDays: [0, 6], // Hide weekends
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventColor: '#4FD1C5', 
            eventTextColor: '#FFFFFF',
            dayMaxEventRows: true,
            height: 'auto',
        });
        calendar.render();
    }

    // Trigger initialization on various events
    document.addEventListener('DOMContentLoaded', () => {
        console.log('DOMContentLoaded');
        initializeCalendar();
    });

    document.addEventListener('livewire:init', () => {
        console.log('Livewire is loading...');
        initializeCalendar();
    });

    document.addEventListener('livewire:initialized', () => {
        console.log('Livewire has initialized.');
        initializeCalendar();
    });

    document.addEventListener('livewire:updated', () => {
        console.log('Livewire updated.');
        initializeCalendar();
    });
</script>