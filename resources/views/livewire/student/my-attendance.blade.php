<div>
    <div class="p-2 sm:p-4 md:p-6 lg:p-8 rounded-2xl  max-w-6xl mx-auto">
        <h4 class="text-xl sm:text-2xl md:text-3xl font-bold text-teal-700 mb-3 sm:mb-4 md:mb-6">My Attendance</h4>

        <div class="mb-4 sm:mb-6 md:mb-8 bg-white p-3 sm:p-4 md:p-6 rounded-lg shadow-sm">
            <p class="text-sm sm:text-base md:text-lg text-gray-700 mb-2">
                <span class="font-medium">Present Days:</span>
                <span class="text-green-600 font-semibold">{{ $presentCount }}</span>
            </p>
            <p class="text-sm sm:text-base md:text-lg text-gray-700 mb-2">
                <span class="font-medium">Absent Days:</span>
                <span class="text-red-600 font-semibold">{{ $absentCount }}</span>
            </p>
            <p class="text-sm sm:text-base md:text-lg text-gray-700">
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

        <div class="bg-white p-3 sm:p-4 md:p-6 rounded-lg shadow-sm">
            <div id="calendar" wire:ignore></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"
        onerror="console.error('Failed to load FullCalendar from ')"></script>

    <style>
        @media (max-width: 640px) {
            .fc .fc-button {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }

            .fc .fc-toolbar-title {
                font-size: 0.9rem;
            }

            .fc .fc-timegrid-slot {
                height: 1.5rem;
            }

            .fc .fc-daygrid-day {
                font-size: 0.75rem;
            }

            #calendar {
                font-size: 0.875rem;
            }

            .fc-toolbar-chunk {
                display: flex;
                flex-wrap: wrap;
                gap: 0.25rem;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .fc .fc-button {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            .fc .fc-toolbar-title {
                font-size: 1.25rem;
            }
        }

        @media (min-width: 1025px) {
            .fc .fc-button {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }

            .fc .fc-toolbar-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:navigated', () => {
            console.log('livewire:navigated');
            initializeCalendar();
        });

        function initializeCalendar() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl || typeof FullCalendar === 'undefined') {
                console.error('Calendar element or FullCalendar not ready yet.');
                setTimeout(initializeCalendar, 50); 
                return;
            }

            if (calendarEl.fullCalendar) {
                calendarEl.fullCalendar.destroy();
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: getInitialView(),
                events: @json($events),
                eventDisplay: 'block',
                hiddenDays: [0, 6], // Hide weekends
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay', 
                },
                eventColor: '#4FD1C5',
                eventTextColor: '#FFFFFF',
                dayMaxEventRows: true,
                height: 'auto',
                slotMinTime: '08:00:00',
                slotMaxTime: '18:00:00',
                views: {
                    dayGridMonth: {
                        dayMaxEventRows: 2 
                    },
                    timeGridWeek: {
                        slotDuration: '00:30:00', 
                        scrollTime: '08:00:00' 
                    },
                    timeGridDay: {
                        slotDuration: '00:30:00' 
                    }
                },
                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    alert('Event: ' + info.event.title + '\nDate: ' + info.event.start.toLocaleDateString());
                },
                eventLongPressDelay: 500,
            });
            calendar.render();

            // Re-render on resize
            window.addEventListener('resize', () => {
                calendar.updateSize();
                calendar.changeView(getInitialView());
            });
        }

        function getInitialView() {
            if (window.innerWidth < 640) return 'timeGridWeek'; 
            if (window.innerWidth < 1024) return 'dayGridMonth';
            return 'dayGridMonth'; 
        }

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
</div>