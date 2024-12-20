@extends('admin.base')

@section('content')
<div class="container">
    <h1>Quiz Results for "{{ $quiz->question }}"</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Answer</th>
                <th>Obtained Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $answer)
                <tr>
                    <td>{{ $answer->user->name }}</td>
                    <td>{{ $answer->answer }}</td>
                    <td>{{ $answer->obtained_marks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection