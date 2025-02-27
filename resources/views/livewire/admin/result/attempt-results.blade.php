<div>
    <h2>{{ $exam->exam_name }} - {{ $user->name }}'s Attempts</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Attempt Number</th>
                <th>Total Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attempts as $attempt)
                <tr>
                    <td>{{ $attempt->attempt }}</td>
                    <td>{{ $attempt->total_marks }}</td>
                    <td>
                        <a href="{{ route('admin.results.attempt-details', [$exam->id, $user->id, $attempt->attempt]) }}"
                           class="btn btn-sm btn-primary">
                            View Details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No attempts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>