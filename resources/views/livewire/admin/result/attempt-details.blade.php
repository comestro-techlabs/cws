<div>
    <h2>{{ $exam->exam_name }} - {{ $user->name }} - Attempt {{ $attempt }}</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Marks Obtained</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($answers as $answer)
                <tr>
                    <td>{{ $answer->quiz->question ?? 'N/A' }}</td>
                    <td>{{ $answer->answer }}</td>
                    <td>{{ $answer->obtained_marks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No answers found for this attempt</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>