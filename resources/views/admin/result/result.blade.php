@extends('admin.base')

@section('content')



<div class="container">
   

    <table class="min-w-full table-auto mt-4">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Obtained Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $answer)
                <tr>

                    <td class="px-4 py-2 text-left border">{{ $answer->user->name }}</td>
                    <td class="px-4 py-2 text-left border">{{ $answer->quiz->question }}</td>
                    <td class="px-4 py-2 text-left border">{{ $answer->selected_option }}</td>
                    <td class="px-4 py-2 text-left border">{{ $answer->obtained_marks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

