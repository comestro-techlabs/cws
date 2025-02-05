@extends('admin.base')

@section('content')

<div class="flex flex-wrap justify-between items-center p-4">
    <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5"> Manage Exams</h2>
    <a href="{{ route('exam.create') }}"
        class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0">
        Create New Exam
        <i class="bi bi-arrow-down-short font-bold"></i>
    </a>
</div>

<div class="max-w-6xl mx-auto mt-10">
   
   
    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif
 
    <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search..." class="border px-3 py-2 rounded w-full" value="{{ request('search') }}">
    </form>
    <div class="overflow-x-auto flex-wrap">
    <table class="w-full border-collapse border">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Course</th>
                <th class="border px-4 py-2">Batch</th>
                <th class="border px-4 py-2">Exam Name</th>
                <th class="border px-4 py-2">Exam Date</th>
                <th class="border px-4 py-2">status</th>

                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
                <tr>
                    <td class="border px-4 py-2">{{ $exam->id }}</td>
                    <td class="border px-4 py-2">{{ $exam->course->title }}</td>
                    <td class="border px-4 py-2">{{ $exam->batch->batch_name}}</td>
                    <td class="border px-4 py-2">{{ $exam->exam_name }}</td>
                    <td class="border px-4 py-2">{{ $exam->exam_date }}</td>
                    <td class="border px-4 py-2">
                        {{-- Status Toggle --}}
                        <form action="{{ route('exam.toggleStatus', $exam->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="status" 
                                    class="sr-only peer" 
                                    onchange="this.form.submit()" 
                                    {{ $exam->status ? 'checked' : '' }}
                                    {{ $exam->quizzes->count() < 10 && !$exam->status ? 'disabled' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                            </label>
                        </form>
                       
                    </td>
                    
                    <td class="border px-4 py-2">
                        <div class="flex flex-wrap gap-2">
                        <a href="{{ route('exam.edit', $exam->id) }}"  class="bg-blue-500 text-white py-2 px-4 rounded w-full sm:w-auto text-center">Edit</a>
                        <form action="{{ route('exam.destroy', $exam->id) }}" method="POST" class="inline-block w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded  w-full sm:w-auto text-center" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <a href="{{ route('exam.showQuestions', ['exam' => $exam->id,'course_title'=>$exam->course->title,'exam_name'=>$exam->exam_name]) }}" class="bg-green-500 text-white py-2 px-4 rounded w-full sm:w-auto text-center ">View</a>
                    </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</div>
@endsection
