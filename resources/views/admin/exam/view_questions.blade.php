@extends('admin.base')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <div class="flex mb-6">
    <a href="{{route('exam.show')}}" class="bg-blue-500 text-white py-2 px-4 ml-auto rounded">Back</a>

    </div>
    <div class="flex">
        <h2 class="text-2xl font-bold mb-6 ">Exam Name : {{$exam_name}}</h2>
        <h2 class="text-2xl font-bold mb-6 ml-auto">Course Name: {{$course_title}}</h2>
    </div>
    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif



    <table class="w-full border-collapse border">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Question</th>
                <th class="border px-4 py-2">Option1</th>
                <th class="border px-4 py-2">Option2</th>
                <th class="border px-4 py-2">Option3</th>
                <th class="border px-4 py-2">Option4</th>
                <th class="border px-4 py-2">Duration</th>
                <th class="border px-4 py-2">Answer</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizQuestions as $question)
            <tr>
                <td class="border px-4 py-2">{{ $question->id }}</td>
                <td class="border px-4 py-2">{{ $question->question }}</td>
                <td class="border px-4 py-2">{{ $question->option1 }}</td>
                <td class="border px-4 py-2">{{ $question->option2 }}</td>
                <td class="border px-4 py-2">{{ $question->option3 }}</td>
                <td class="border px-4 py-2">{{ $question->option4 }}</td>
                <td class="border px-4 py-2">{{ $question->time }}</td>
                <td class="border px-4 py-2">{{ $question->correct_answer }}</td>
                <td class="border px-4 py-2">
                        <div class="flex gap-2">
                        <form action="{{route('quizQuestion.destroy',$question->id)}}" method="POST" class="inline-block">  
                            @csrf   
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded" >Delete</button>
                        </form>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>



</div>
@endsection