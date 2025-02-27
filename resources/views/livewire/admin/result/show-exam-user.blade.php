<div>
    <h2>{{ $exam->exam_name }} - Users</h2>

    <table class="table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Total Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($examuser as $eu)
                <tr>
                    <td>{{ $eu->user->name }}</td>
                    <td>{{ $eu->total_marks }}</td>
                    <td>
                        <a href="{{ route('admin.results.attempts', [$exam->id, $eu->user->id]) }}"
                           class="btn btn-sm btn-primary">
                            View Attempts
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No users found for this exam</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>