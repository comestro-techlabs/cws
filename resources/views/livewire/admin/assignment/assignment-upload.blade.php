<div>
    <!-- Navigation Bar -->
    <nav class="mb-4">
        <button wire:click="goToIndex" class="btn btn-outline-primary {{ $viewMode === 'index' ? 'active' : '' }}">All Uploads</button>
        <button wire:click="goToAssignmentCourse" class="btn btn-outline-primary {{ $viewMode === 'assignmentCourse' ? 'active' : '' }}">Courses</button>
        <!-- Example: Add a dropdown or input for assignmentReview if needed -->
        @if ($viewMode === 'assignmentReview' || $viewMode === 'singleStudent' || $viewMode === 'reviewWork')
            <span class="ml-2">Current: {{ $viewMode === 'assignmentReview' ? $course->title : ($viewMode === 'singleStudent' ? $student->name : $assignment->title) }}</span>
        @endif
    </nav>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Index View -->
    @if ($viewMode === 'index')
        <h1>Assignment Uploads</h1>
        <button wire:click="syncFiles" class="btn btn-primary">Sync Files</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fileData as $file)
                    <tr>
                        <td>{{ $file['id'] }}</td>
                        <td>{{ $file['name'] }}</td>
                        <td>{{ $file['course'] }}</td>
                        <td><a href="#" wire:click="goToSingleStudent('{{ $file['user_id'] ?? '' }}')">{{ $file['user'] }}</a></td>
                        <td>{{ $file['status'] }}</td>
                        <td>{{ $file['submitted_at'] }}</td>
                        <td>
                            <button wire:click="downloadFile('{{ $file['id'] }}')" class="btn btn-sm btn-secondary">Download</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Assignment Course View -->
    @if ($viewMode === 'assignmentCourse')
        <h1>Assignment Courses</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Total Users</th>
                    <th>Unique Submissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td><a href="#" wire:click="goToAssignmentReview('{{ $course->slug }}')">{{ $course->title }}</a></td>
                        <td>{{ $course->total_users }}</td>
                        <td>{{ $course->unique_user_count }}</td>
                        <td>
                            <button wire:click="goToAssignmentReview('{{ $course->slug }}')" class="btn btn-sm btn-primary">Review</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Assignment Review View -->
    @if ($viewMode === 'assignmentReview')
        <h1>{{ $course->title }} - Assignment Review</h1>

        <h2>Assignments</h2>
        <table class="table mb-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Total Submissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    <tr>
                        <td><a href="#" wire:click="goToReviewWork('{{ $assignment->id }}')">{{ $assignment->title }}</a></td>
                        <td>{{ $assignment->uploads->count() }}</td>
                        <td>
                            <button wire:click="goToReviewWork('{{ $assignment->id }}')" class="btn btn-sm btn-primary">Review Work</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Student Submissions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Assignment</th>
                    <th>File Path</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $studentId => $data)
                    @foreach ($data['uploads'] as $upload)
                        <tr>
                            <td><a href="#" wire:click="goToSingleStudent('{{ $studentId }}')">{{ $data['user']->name }}</a></td>
                            <td><a href="#" wire:click="goToReviewWork('{{ $upload['assignment_id'] }}')">{{ $assignments->firstWhere('id', $upload['assignment_id'])->title }}</a></td>
                            <td>{{ $upload['file_path'] }}</td>
                            <td>{{ $upload['status'] }}</td>
                            <td>{{ $upload['submitted_at'] }}</td>
                            <td>{{ $upload['grade'] ?? 'Not graded' }}</td>
                            <td>
                                <button wire:click="downloadFile('{{ $upload['file_path'] }}')" class="btn btn-sm btn-secondary">Download</button>
                                <input type="text" wire:model="grade" class="form-control d-inline w-25" placeholder="Grade">
                                <button wire:click="insertGrade({{ $upload['assignment_id'] }}, {{ $studentId }})" class="btn btn-sm btn-primary">Grade</button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Single Student Assignment View -->
    @if ($viewMode === 'singleStudent')
        <h1>{{ $student->name }} - Assignments</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Assignment Title</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    <tr>
                        <td><a href="#" wire:click="goToReviewWork('{{ $assignment->assignment->id }}')">{{ $assignment->assignment->title }}</a></td>
                        <td>{{ $assignment->status }}</td>
                        <td>{{ $assignment->submitted_at }}</td>
                        <td>
                            <button wire:click="goToReviewWork('{{ $assignment->assignment->id }}')" class="btn btn-sm btn-primary">Review Work</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Review Work View -->
    @if ($viewMode === 'reviewWork')
        <h1>{{ $assignment->title }} - Review Work</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>File Path</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $studentId => $data)
                    @foreach ($data['uploads'] as $upload)
                        <tr>
                            <td><a href="#" wire:click="goToSingleStudent('{{ $studentId }}')">{{ $data['name'] }}</a></td>
                            <td>{{ $upload->file_path }}</td>
                            <td>{{ $upload['grade'] ?? 'Not graded' }}</td>
                            <td>
                                <@foreach ($students as $studentId => $data)
                                    @foreach ($data['uploads'] as $upload)
                                        <tr>
                                            <td><a href="#" wire:click="goToSingleStudent('{{ $studentId }}')">{{ $data['user']->name }}</a></td>
                                            <td><a href="#" wire:click="goToReviewWork('{{ $upload['assignment_id'] }}')">{{ $assignments->firstWhere('id', $upload['assignment_id'])->title }}</a></td>
                                            <td>{{ $upload['file_path'] }}</td>
                                            <td>{{ $upload['status'] }}</td>
                                            <td>{{ $upload['submitted_at'] }}</td>
                                            <td>{{ $upload['grade'] ?? 'Not graded' }}</td>
                                            <td>
                                                <button wire:click="downloadFile('{{ $upload['file_path'] }}')" class="btn btn-sm btn-secondary">Download</button>
                                                <input type="text" wire:model="grade" class="form-control d-inline w-25" placeholder="Grade">
                                                <button wire:click="insertGrade({{ $upload['assignment_id'] }}, {{ $studentId }})" class="btn btn-sm btn-primary">Grade</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach 
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>