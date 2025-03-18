<!-- resources/views/livewire/admin/certificate/manage-certificate.blade.php -->
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Manage Certificates</h2>

    <select wire:model.live="selectedCourse" class="mb-4 p-2 border rounded w-full max-w-xs">
        <option value="">Select Course</option>
        @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->title }}</option>
        @endforeach
    </select>

    <div class="tabs flex space-x-2 mb-4">
        <button wire:click="$set('activeTab', 'eligible')" 
                class="px-4 py-2 rounded {{ $activeTab === 'eligible' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            Eligible Students
        </button>
        <button wire:click="$set('activeTab', 'not-eligible')"
                class="px-4 py-2 rounded {{ $activeTab === 'not-eligible' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            Not Eligible Students
        </button>
    </div>

    @if($activeTab === 'eligible')
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Student</th>
                        <th class="p-2">Exam %</th>
                        <th class="p-2">Overall %</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($eligibleStudents as $student)
                        <tr>
                            <td class="p-2">{{ $student['user']->name }}</td>
                            <td class="p-2">{{ number_format($student['exam_percentage'], 2) }}%</td>
                            <td class="p-2">{{ number_format($student['overall_percentage'], 2) }}%</td>
                            <td class="p-2 flex space-x-2">
                                @if(!$student['certificate'] || !$student['certificate']->admin_approve)
                                    <button wire:click="approveCertificate('{{ $student['user']->id }}')"
                                            class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                                        Approve
                                    </button>
                                @endif
                                <button onclick="window.print()" 
                                        class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                    Print
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-2 text-center">No eligible students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Student</th>
                        <th class="p-2">Exam %</th>
                        <th class="p-2">Assignment Grades</th>
                        <th class="p-2">Overall %</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notEligibleStudents as $student)
                        <tr>
                            <td class="p-2">{{ $student['user']->name }}</td>
                            <td class="p-2">
                                {{ $student['exam_percentage'] !== null ? number_format($student['exam_percentage'], 2) . '%' : 'N/A' }}
                            </td>
                            <td class="p-2">
                                @if($student['assignments']->isNotEmpty())
                                    @foreach($student['assignments'] as $assignment)
                                        {{ $assignment->grade }}@if(!$loop->last), @endif
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="p-2">
                                {{ $student['overall_percentage'] !== null ? number_format($student['overall_percentage'], 2) . '%' : 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-2 text-center">No ineligible students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>