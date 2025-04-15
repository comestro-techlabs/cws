<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Attendance Overview</h1>
            <p class="mt-1 text-sm text-gray-500">Track your class attendance and performance</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
            <!-- Present Days Card -->
            <div class="bg-white overflow-hidden rounded-lg shadow-sm border border-green-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-green-50 rounded-md p-3">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Present Days</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $presentCount }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Absent Days Card -->
            <div class="bg-white overflow-hidden rounded-lg shadow-sm border border-red-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-red-50 rounded-md p-3">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Absent Days</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $absentCount }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Status Card -->
            <div class="bg-white overflow-hidden rounded-lg shadow-sm border border-blue-100">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-blue-50 rounded-md p-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Today's Status</dt>
                                <dd class="flex items-baseline">
                                    @if($todayStatus === 'Present')
                                        <div class="text-lg font-medium text-green-600">Present</div>
                                    @elseif($todayStatus === 'Absent')
                                        <div class="text-lg font-medium text-red-600">Absent</div>
                                    @else
                                        <div class="text-lg font-medium text-gray-400">Not Recorded</div>
                                    @endif
                                    <span class="ml-2 text-sm text-gray-500">
                                        ({{ \Carbon\Carbon::today()->format('d M Y') }})
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 px-6 py-4">
                <h2 class="text-lg font-medium text-gray-900">Attendance Calendar</h2>
                <p class="mt-1 text-sm text-gray-500">View your attendance records and upcoming schedule</p>
            </div>
            <div class="p-6">
                <div id="calendar" wire:ignore></div>
            </div>
        </div>
    </div>


    <!-- FullCalendar CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"
        onerror="console.error('Failed to load FullCalendar')"></script>
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

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

        #emailModal.show {
            opacity: 1;
        }

        #emailModal.show #emailModalContent {
            scale: 1;
            opacity: 1;
        }

        .fc .fc-day-disabled {
            background: #f3f4f6;
            cursor: not-allowed;
        }

        .ck-editor__editable {
            min-height: 150px;
        }
    </style>

    <script>
        let selectedDate = null;
        const studentJoinDate = @json(Carbon\Carbon::parse($student->created_at)->toDateString());
        let editorInstance = null;
        let calendarInstance = null; // Store calendar instance

        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOMContentLoaded');
            initializeCalendar();
        });

        function initializeCalendar() {
            const calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error('Calendar element not found.');
                return;
            }

            // Destroy existing calendar instance if it exists
            if (calendarInstance) {
                calendarInstance.destroy();
            }

            calendarInstance = new FullCalendar.Calendar(calendarEl, {
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

            calendarInstance.render();
            console.log('Calendar initialized.');

            // Update calendar size after rendering
            setTimeout(() => {
                calendarInstance.updateSize();
            }, 100);

            window.addEventListener('resize', () => {
                calendarInstance.updateSize();
                calendarInstance.changeView(getInitialView());
            });
        }

        function openEmailModal(date, eventTitle) {
            const modal = document.getElementById('emailModal');
            const modalContent = document.getElementById('emailModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('show');
                if (!editorInstance) {
                    const element = document.getElementById('emailMessage');
                    if (!element) {
                        console.error('CKEditor textarea element not found.');
                        return;
                    }
                    if (typeof ClassicEditor === 'undefined') {
                        console.error('CKEditor script not loaded yet.');
                        setTimeout(() => openEmailModal(date, eventTitle), 200);
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
                            editor.setData('');
                            editor.editing.view.focus();
                            console.log('CKEditor initialized successfully.');
                        })
                        .catch(error => {
                            console.error('CKEditor initialization failed:', error);
                        });
                } else {
                    editorInstance.setData('');
                    editorInstance.editing.view.focus();
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

        // Livewire event listeners
        document.addEventListener('livewire:navigated', () => {
            console.log('livewire:navigated');
            setTimeout(() => {
                initializeCalendar();
            }, 100);
        });

        document.addEventListener('livewire:updated', () => {
            console.log('livewire:updated');
            setTimeout(() => {
                initializeCalendar();
            }, 100);
        });

        // Listen for tab switch event
        window.addEventListener('show-attendance-tab', () => {
            console.log('Attendance tab shown');
            setTimeout(() => {
                initializeCalendar();
            }, 100);
        });
    </script>
</div>