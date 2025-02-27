<div>
    <div class="mb-4">
        <input 
            wire:model.debounce.500ms="search" 
            type="text" 
            class="form-control" 
            placeholder="Search exams..."
        >
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Exam Name</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($exams as $exam)
                <tr>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->course->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.results.exam-user', $exam->id) }}" 
                           class="btn btn-sm btn-primary">
                            View Users
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No exams found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $exams->links() }}
    </div>
</div>