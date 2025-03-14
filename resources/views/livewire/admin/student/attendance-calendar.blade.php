<div>
    <!-- Email Modal with CKEditor -->
    <div id="emailModal" wire:wire:ignore class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50 transition-opacity duration-300" wire:ignore>
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full m-4 transform transition-all duration-300 scale-95 opacity-0" id="emailModalContent">
            <h3 class="text-lg font-bold text-teal-700 mb-4">Send Message to Student</h3>
            <div id="ckeditor-container" class="mb-4">
                <textarea id="emailMessage" class="hidden"></textarea> <!-- Hidden textarea for CKEditor -->
            </div>
            <div class="flex justify-end gap-2">
                <button id="cancelEmail" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">Cancel</button>
                <button id="sendEmail" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200">Send</button>
            </div>
        </div>
    </div>

    <div class="p-2 sm:p-4 md:p-6 lg:p-8 rounded-2xl max-w-6xl mx-auto">
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

    <!-- FullCalendar CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js" onerror="console.error('Failed to load FullCalendar')"></script>
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <style>
        @media (max-width: 640px) {
            .fc .fc-button { padding: 0.2rem 0.4rem; font-size: 0.7rem; }
            .fc .fc-toolbar-title { font-size: 0.9rem; }
            .fc .fc-timegrid-slot { height: 1.5rem; }
            .fc .fc-daygrid-day { font-size: 0.75rem; }
            #calendar { font-size: 0.875rem; }
            .fc-toolbar-chunk { display: flex; flex-wrap: wrap; gap: 0.25rem; }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .fc .fc-button { padding: 0.375rem 0.75rem; font-size: 0.875rem; }
            .fc .fc-toolbar-title { font-size: 1.25rem; }
        }

        @media (min-width: 1025px) {
            .fc .fc-button { padding: 0.5rem 1rem; font-size: 1rem; }
            .fc .fc-toolbar-title { font-size: 1.5rem; }
        }

        #emailModal.show { opacity: 1; }
        #emailModal.show #emailModalContent { scale: 1; opacity: 1; }
        .fc .fc-day-disabled { background: #f3f4f6; cursor: not-allowed; }
        .ck-editor__editable { min-height: 150px; }
    </style>

    <script>
        let selectedDate = null;
        const studentJoinDate = @json(Carbon\Carbon::parse($student->created_at)->toDateString());
        let editorInstance = null;

        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOMContentLoaded');
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
                hiddenDays: [0, 6],
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
                validRange: { start: studentJoinDate },
                views: {
                    dayGridMonth: { dayMaxEventRows: 2 },
                    timeGridWeek: { slotDuration: '00:30:00', scrollTime: '08:00:00' },
                    timeGridDay: { slotDuration: '00:30:00' }
                },
                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    selectedDate = info.event.start.toISOString().split('T')[0];
                    openEmailModal(selectedDate, info.event.title);
                },
                dateClick: function (info) {
                    selectedDate = info.dateStr;
                    const clickedDate = new Date(selectedDate);
                    const joinDate = new Date(studentJoinDate);
                    if (clickedDate >= joinDate) {
                        openEmailModal(selectedDate, 'No Event');
                    } else {
                        alert('Cannot send message for dates before the student joined.');
                    }
                },
                eventLongPressDelay: 500,
            });
            calendar.render();

            window.addEventListener('resize', () => {
                calendar.updateSize();
                calendar.changeView(getInitialView());
            });
        }

        function openEmailModal(date, eventTitle) {
            const modal = document.getElementById('emailModal');
            const modalContent = document.getElementById('emailModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('show');
                // Initialize CKEditor if not already initialized
                if (!editorInstance) {
                    const element = document.getElementById('emailMessage');
                    if (!element) {
                        console.error('CKEditor textarea element not found.');
                        return;
                    }
                    if (typeof ClassicEditor === 'undefined') {
                        console.error('CKEditor script not loaded yet.');
                        setTimeout(() => openEmailModal(date, eventTitle), 200); // Retry after delay
                        return;
                    }
                    ClassicEditor
                        .create(element, {
                            toolbar: [
                                'heading', '|',
                                'bold', 'italic', 'link', '|',
                                'bulletedList', 'numberedList', '|',
                                'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                'outdent', 'indent', '|',
                                'undo', 'redo'
                            ],
                            image: {
                                toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                            }
                        })
                        .then(editor => {
                            editorInstance = editor;
                            editor.setData(''); // Clear content on first open
                            editor.editing.view.focus(); // Focus the editor
                            console.log('CKEditor initialized successfully.');
                        })
                        .catch(error => {
                            console.error('CKEditor initialization failed:', error);
                        });
                } else {
                    editorInstance.setData(''); // Clear content for subsequent opens
                    editorInstance.editing.view.focus(); // Focus the editor
                }
            }, 10);

            document.getElementById('sendEmail').onclick = function () {
                if (!editorInstance) {
                    console.error('CKEditor not initialized yet.');
                    return;
                }
                const message = editorInstance.getData().trim();
                if (message) {
                    @this.call('sendEmail', selectedDate, message);
                    closeEmailModal();
                } else {
                    alert('Please enter a message.');
                }
            };

            document.getElementById('cancelEmail').onclick = closeEmailModal;

            modal.onclick = function (e) {
                if (e.target === modal) closeEmailModal();
            };

            document.addEventListener('keydown', function escListener(e) {
                if (e.key === 'Escape') {
                    closeEmailModal();
                    document.removeEventListener('keydown', escListener);
                }
            });
        }

        function closeEmailModal() {
            const modal = document.getElementById('emailModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function getInitialView() {
            if (window.innerWidth < 640) return 'timeGridWeek';
            if (window.innerWidth < 1024) return 'dayGridMonth';
            return 'dayGridMonth';
        }

        // Handle Livewire events
        document.addEventListener('livewire:navigated', () => {
            console.log('livewire:navigated');
            initializeCalendar();

            setTimeout(() => {
            initializeCKEditor();
        }, 200);
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

            setTimeout(() => {
            initializeCKEditor();
        }, 200);
        });
    </script>
</div>