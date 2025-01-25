@extends('admin.base')

@section('title', 'Edit Student | ')

@php
    $fields = ['name', 'email', 'contact', 'gender', 'education_qualification', 'dob', 'profile_picture'];
    $countCompletedFields = 0;
    foreach ($fields as $field) {
        if ($student->$field) {
            $countCompletedFields++;
        }
    }
    $totalFields = count($fields);
@endphp

@section('content')
    @if (session('success'))
        <div class="mb-4 p-4 mt-5 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 mt-5 bg-red-100 text-red-800 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-1 w-full px-[2%] py-0 flex-col">
        <div class="flex flex-1 gap-3 my-5 flex-row justify-between items-center">
            <div class="flex flex-1 flex-col border-s-4 border-s-orange-400 pl-3">
                <h2 class="md:text-xl text-lg font-normal  text-slate-500">Edit Student</h2>
                <p class="text-sm text-slate-400 font-normal">Please fill {{ $countCompletedFields }} of {{ $totalFields }}
                    fields</p>
            </div>
        </div>

        <div class="flex flex-1 flex-col md:items-start gap-5">
            <div class="grid grid-cols-2 gap-5 w-full">
                @foreach ($fields as $field)
                    <div class="flex flex-1 bg-slate-100 p-3 rounded border">
                        <div class="flex flex-1 flex-col gap-2">
                            <div class="flex flex-1 justify-between">
                                <strong
                                    class="text-lg font-normal text-slate-600">{{ ucfirst(str_replace('_', ' ', $field)) }}</strong>
                                <button onclick="toggleEdit('{{ $field }}')"
                                    class="bg-teal-600 text-white text-sm px-3 py-1 self-start rounded">Edit</button>
                            </div>

                            <span id="{{ $field }}-value">
                                @if ($student->$field)
                                    {!! $field == 'profile_picture'
                                        ? "<img src='" .
                                            ($student->$field
                                                ? asset('storage/student_images/' . $student->$field)
                                                : 'https://placehold.co/600x400?text=Upload+Image') .
                                            "' alt='Profile Picture' class='w-full h-auto object-cover border'>"
                                        : e($student->$field) !!}
                                @else
                                    <span class="italic">{{ ucfirst(str_replace('_', ' ', $field)) }} is empty</span>
                                @endif
                            </span>

                            <form id="{{ $field }}-form"
                                action="{{ route('student.update', ['student' => $student->id, 'field' => $field]) }}"
                                method="POST" enctype="multipart/form-data" style="display: none;"
                                class="flex flex-col w-full">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3 flex flex-1 flex-col gap-1">
                                    @if ($field == 'profile_picture')
                                        <input type="file" name="{{ $field }}" id="{{ $field }}"
                                            onchange="previewImage(event)">
                                        <div class="mt-2">
                                            <img id="{{ $field }}-preview"
                                                src="{{ $student->$field ? asset('storage/student_images/' . $student->$field) : 'https://placehold.co/600x400?text=Upload+Image' }}"
                                                alt="Profile Picture Preview" class="w-56 h-32 object-cover border">
                                        </div>
                                    @elseif ($field == 'dob')
                                        <input class="border w-full px-3 py-2" type="date" name="{{ $field }}"
                                            value="{{ $student->$field }}">
                                    @elseif ($field == 'gender')
                                        <select class="border w-full px-3 py-2" name="{{ $field }}">
                                            <option value="male" {{ $student->$field == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ $student->$field == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="other" {{ $student->$field == 'other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                    @else
                                        <input class="border w-full px-3 py-2"
                                            type="{{ $field == 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                                            value="{{ $student->$field }}">
                                    @endif
                                </div>

                                <div class="flex gap-2">
                                    <button type="submit" class="bg-black text-white px-3 py-2 rounded">Save</button>
                                    <button type="button" onclick="toggleEdit('{{ $field }}')"
                                        class="bg-gray-500 text-white px-3 py-2 rounded">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                <h2 class="border-s-4 border-s-orange-400 pl-3 text-teal-500 font-semibold text-xl py-2 mb-2">Purchased
                    Courses</h2>
                {{-- {{ dd($purchasedCourses) }} --}}
                @if ($purchasedCourses->isNotEmpty())
                    <ul>
                        @foreach ($purchasedCourses as $purchased)
                            <li>
                                <strong>Course:</strong> {{ $purchased->course->title }} <br>
                                <strong>Fees:</strong> {{ $purchased->course->fees }} <br>
                                <strong>Payment Amount:</strong> {{ $purchased->amount }} <br>
                                <strong>Payment Date:</strong> {{ $purchased->payment_date }} <br>
                                <strong>Payment Status:</strong>
                                @if ($purchased->payment_status === 'captured')
                                    Successful
                                @else
                                    {{ $purchased->payment_status }}
                                @endif
                                <br>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No purchased courses found.</p>
                @endif
            </div>


        </div>

    @endsection
