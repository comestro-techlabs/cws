@extends('admin.base')

@section('content')
@if (session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class=" mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-6">Add a Quiz Question</h1>
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div>
            {{-- {{dd($selectedExamId)}} --}}
            <label class="block text-gray-700 mb-2">Exam</label>
            @if (isset($selectedExamId))
            <input type="hidden" name="exam_id" value="{{ $selectedExamId }}">
            <input type="text" class="w-full border px-3 py-2 rounded bg-gray-100" value="{{ $exams->firstWhere('id', $selectedExamId)->exam_name }}" readonly>
        @else
            <select name="exam_id" class="w-full border px-3 py-2 rounded">
                <option value="" disabled {{ old('exam_id') == '' ? 'selected' : '' }}>Select an Exam</option>
                @foreach ($exams as $exam)
                <option value="{{ $exam->id }}" {{ old('exam_id') == $exam->id ? 'selected' : '' }}>
                    {{ $exam->exam_name }}
                </option>
                @endforeach
            </select>
        @endif
            @error('exam_id')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Question</label>
            <textarea name="question" class="w-full border px-3 py-2 rounded" rows="4">{{old('question')}}</textarea>
            @error('question')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <input type="text" name="option1" placeholder="Option 1" class="w-full border px-3 py-2 rounded" value="{{old('option1')}}">
                @error('option1')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="option2" placeholder="Option 2" class="w-full border px-3 py-2 rounded" value="{{old('option2')}}">
                @error('option2')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="option3" placeholder="Option 3" class="w-full border px-3 py-2 rounded" value="{{old('option3')}}">
                @error('option3')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="option4" placeholder="Option 4" class="w-full border px-3 py-2 rounded" value="{{old('option4')}}">
                @error('option4')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Correct Answer</label>
            <select name="correct_answer" class="w-full border px-3 py-2 rounded">
                <option value="" selected disabled>Select Correct Answer</option>
                <option value="option1" {{ old('correct_answer') == 'option1' ? 'selected' : '' }}>Option 1</option>

                <option value="option2" {{ old('correct_answer') == 'option2' ? 'selected' : '' }}>Option 2</option>
                <option value="option3" {{ old('correct_answer') == 'option3' ? 'selected' : '' }}>Option 3</option>
                <option value="option4" {{ old('correct_answer') == 'option4' ? 'selected' : '' }}>Option 4</option>
            </select>
            @error('correct_answer')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        {{-- <div class="mt-4">
            <label for="time" class="block text-gray-700 mb-2">Time (in minutes)</label>
            <input type="number" name="time" id="time"  class="w-full border px-3 py-2 rounded" value="2">

            @error('time')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div> --}}
        {{-- <div class="mt-4">
            <label class="block text-gray-700 mb-2">Status</label>
            <input type="checkbox" name="status" value="1" class="mr-2"> Active
            @error('status')
            <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div> --}}
        <button class="mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save Quiz</button>
    </form>
</div>
@endsection
