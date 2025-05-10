<div class="p-6">
    <div class="mb-6 bg-white rounded-lg shadow">
        <div class="p-4 flex items-center justify-between border-b">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.certificate.course') }}" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="text-lg font-semibold">Student Details</h2>
            </div>
            @if(!$this->certificate)
                <button wire:click="generateCertificate" 
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Generate Certificate
                </button>
            @else
                <div class="flex space-x-2">
                    <button wire:click="toggleApproval({{ $this->certificate->id }})" 
                        class="{{ $this->certificate->admin_approve ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-2 rounded-lg">
                        {{ $this->certificate->admin_approve ? 'Disapprove' : 'Approve' }} Certificate
                    </button>
                   
                </div>
            @endif
        </div>

        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="font-semibold">Student Name:</p>
                    <p>{{ $student->name }}</p>
                </div>
                <div>
                    <p class="font-semibold">Course:</p>
                    <p>{{ $course->title }}</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b mb-4">
                <div class="flex space-x-4">
                    <button wire:click="switchTab('exam')" 
                        class="px-4 py-2 {{ $activeTab === 'exam' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                        Exam Details
                    </button>
                    <button wire:click="switchTab('assignment')" 
                        class="px-4 py-2 {{ $activeTab === 'assignment' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                        Assignment Details
                    </button>
                    <button wire:click="switchTab('mocktest')" 
                        class="px-4 py-2 {{ $activeTab === 'mocktest' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-600' }}">
                        Mock Test Details
                    </button>
                   
                </div>
            </div>

            <!-- Tab Content -->
            @if($activeTab === 'exam')
             @if($examDetails->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Exam Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Total Marks</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Total Questions</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Percentage</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($examDetails as $exam)
                        <tr>
                            <td class="px-6 py-4">{{ $exam['exam_name'] }}</td>
                            <td class="px-6 py-4">{{ $exam['total_marks'] }}/{{ $exam['total_questions'] }}</td>
                            <td class="px-6 py-4">{{ $exam['total_questions'] }}</td>
                            <td class="px-6 py-4">{{ number_format($exam['percentage'], 2) }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No Exam Data</h3>
                        <p class="mt-1 text-sm text-gray-500">This student hasn't taken any exams yet.</p>
                    </div>
                @endif
            @elseif($activeTab === 'assignment')
             @if($assignmentDetails->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Assignment Name</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Submitted At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($assignmentDetails as $assignment)
                        <tr>
                            <td class="px-6 py-4">{{ $assignment['assignment_name'] }}</td>
                            <td class="px-6 py-4">{{ $assignment['due_date'] }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $assignment['status'] === 'graded' ? 'bg-green-100 text-green-800' : 
                                       ($assignment['status'] === 'submitted' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($assignment['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $assignment['grade'] ? $assignment['grade'] . '/100' : 'Not graded' }}</td>
                            <td class="px-6 py-4">{{ $assignment['submitted_at'] ?? 'Not submitted' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No Assignment Data</h3>
                        <p class="mt-1 text-sm text-gray-500">No assignments have been submitted yet.</p>
                    </div>
                @endif
            @else
                @if($mockTestDetails->count() > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Mock Test</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Total Questions</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Completed At</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($mockTestDetails as $test)
                            <tr>
                                <td class="px-6 py-4">{{ $test->mockTest->test_title }}</td>
                                <td class="px-6 py-4">{{ $test->mockTest->course->title }}</td>
                                <td class="px-6 py-4">{{ $test->score }}</td>
                                <td class="px-6 py-4">{{ $test->total_questions }}</td>
                                <td class="px-6 py-4">{{ $test->completed_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No Mock Test Data</h3>
                        <p class="mt-1 text-sm text-gray-500">This student hasn't attempted any mock tests.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
    @if($certificate)
    <div class="mb-6 bg-white rounded-lg shadow">
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">Certificate</h2>
            <div class="flex space-x-2">
                <button onclick="saveCertificate()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Save Certificate</span>
                </button>
                <button onclick="printCertificate()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Print Certificate</span>
                </button>
            </div>
        </div>
        <div class="p-4">
            <div id="certificate-container" class="text-center">
                <div class="relative w-[995px] h-[695px] bg-no-repeat bg-cover shadow-xl" 
                style="background-image: url('{{ asset('certificate.jpeg') }}')">                <div class="absolute top-[350px] left-1/2 transform -translate-x-1/2">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Great Vibes', cursive;">
                            {{ $certificate->user->name }}
                        </h2>
                    </div>
                    
                    <div class="absolute top-[420px] left-[100px] right-[90px] px-8">
                        <p class="text-lg text-gray-800">
                            This certificate is awarded to <strong class="text-black">{{ $certificate->user->name }}</strong> 
                            for achieving a score of <strong class="text-black">{{ number_format($certificate->overall_percentage, 2) }}%</strong> 
                            in recognition of their performance in the final examination, viva voce, and project evaluation 
                            for the course titled <strong class="text-black">{{ $certificate->course->title }}</strong>, 
                            conducted by <strong>Comestro Techlabs Pvt Ltd.</strong>
                        </p>
                    </div>
        
                    <div class="absolute top-[330px] right-[-75px] transform rotate-90 text-gray-800 font-semibold text-lg tracking-wider">
                        Certificate No: {{ $certificate->certificate_no }}
                    </div>
        
                    <div class="absolute bottom-[25px] left-[510px]">
                        <p class="text-lg text-gray-800 text-center">{{ $certificate->date->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #certificate-container,
            #certificate-container * {
                visibility: visible;
            }
            #certificate-container {
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
            }
            #certificate-container .relative {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
            @page {
                size: landscape;
                margin: 0;
            }
        }
    </style>

    <script>
        function printCertificate() {
            // Force background printing in Chrome
            const style = document.createElement('style');
            style.innerHTML = '@page { size: landscape; margin: 0; } body { margin: 0; } #certificate-container { -webkit-print-color-adjust: exact !important; }';
            document.head.appendChild(style);
            window.print();
            document.head.removeChild(style);
        }

        function saveCertificate() {
            const certificateContainer = document.getElementById('certificate-container');
            
            // Create a temporary canvas
            html2canvas(certificateContainer, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: null
            }).then(canvas => {
                // Convert canvas to PNG and download
                const link = document.createElement('a');
                link.download = 'certificate.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>

    <!-- Add html2canvas library -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    @endif
</div>






