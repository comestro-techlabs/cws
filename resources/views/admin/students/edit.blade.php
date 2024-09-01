@extends('admin.base')

@section('title', 'Edit Student | ')

@php
    $fields = [
        'name',
        'email',
        'contact',
        'gender',
        'education_qualification',
        'dob',
        'profile_picture',
    ];
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

    <div class="flex px-[2%] py-0 flex-col">
        <div class="flex gap-3 my-5 flex-row justify-between items-center">
            <div class="flex flex-1 flex-col border-s-4 border-s-orange-400 pl-3">
                <h2 class="md:text-xl text-lg font-normal dark:text-slate-300 text-slate-500">Edit Student</h2>
                <p class="text-sm text-slate-400 font-normal">Please fill {{ $countCompletedFields }} of {{ $totalFields }}
                    fields</p>
            </div>
        </div>

        <div class="flex flex-1 md:flex-row flex-col md:items-start gap-5">
            <div class="flex flex-1 gap-5 flex-col">
                @foreach ($fields as $field)
                    <div class="flex flex-1 bg-slate-100 p-3 rounded border">
                        <div class="flex flex-1 flex-col gap-2">
                            <div class="flex flex-1 justify-between">
                                <strong class="text-lg font-normal text-slate-600">{{ ucfirst(str_replace('_', ' ', $field)) }}</strong>
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
                                method="POST" enctype="multipart/form-data" style="display: none;" class="flex flex-col w-full">
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
                                            <option value="male" {{ $student->$field == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ $student->$field == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ $student->$field == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    @else
                                        <input class="border w-full px-3 py-2"
                                            type="{{ $field == 'email' ? 'email' : 'text' }}"
                                            name="{{ $field }}" value="{{ $student->$field }}">
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

            <!-- Courses Assignment Section -->
            <div class="flex flex-[1.3] gap-3 flex-col">
                <div class="flex flex-1 flex-col bg-slate-100 p-4 rounded-lg border border-slate-300 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-700 mb-4">Assigned Courses</h3>
                
                    <!-- Form to assign a new course -->
                    <div class="mb-5 bg-white p-4 rounded-lg shadow-sm">
                        <form action="{{ route('students.assignCourse', ['student' => $student->id]) }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div>
                                <label for="course_id" class="block text-sm font-medium text-slate-600">Select Course</label>
                                <select name="course_id" id="course_id" class="mt-1 px-3 py-2 block w-full border border-slate-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500">Assign Course</button>
                        </form>
                    </div>
                
                    <!-- List of assigned courses -->
                    <div>
                        <h4 class="text-lg font-semibold text-slate-700 mb-3">Currently Assigned Courses:</h4>
                        <ul class=" space-y-2">
                            @foreach ($student->courses as $course)
                                <li class="flex justify-between items-center bg-white p-2 rounded-md border border-slate-200 shadow-sm gap-2">
                                    <span class="text-slate-800 text-sm capitalize">{{ $course->title }}</span>
                                    <form action="{{ route('students.removeCourse', ['student' => $student->id, 'course' => $course->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                              </svg>
                                              
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
    
               <!-- Payment Options Section -->
<div class="flex flex-1 flex-col bg-slate-100 p-4 rounded border">
    <h3 class="text-lg font-semibold text-slate-600 mb-4">Payment Options</h3>

    <form action="{{ route('students.processPayment', ['student' => $student->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="course_id" class="form-label">Select Course</label>
            <select name="course_id" id="course_id" class="border w-full px-3 py-2">
                @foreach ($student->courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_option" class="form-label">Select Payment Option</label>
            <select name="payment_option" id="payment_option" class="border w-full px-3 py-2">
                <option value="full">Full Payment (5% Discount)</option>
                <option value="installments">50% Now, 50% Later</option>
                <option value="monthly">Monthly Payment (₹700/month)</option>
            </select>
        </div>

        <button type="submit" class="bg-teal-600 text-white px-3 py-2 rounded">Process Payment</button>
    </form>
</div>

    
<div class="flex flex-1 flex-col bg-slate-100 p-4 rounded border shadow-sm">
    <h3 class="text-lg font-bold text-slate-700 mb-4">Course Payments</h3>

    @foreach ($paymentsGroupedByCourse as $courseId => $payments)
        @php
            $course = $payments->first()->course; // Get the course details from the first payment
            $paymentOption = $payments->first()->payment_option; // Get the payment option from the first payment
        @endphp
        
        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <div class="mb-3 flex justify-between items-center">
                <h4 class="text-base font-semibold text-slate-800">
                    Course: {{ $course->title }}
                </h4>
                <span class="text-base font-semibold text-teal-600">
                    Payment Option: {{ ucfirst($paymentOption) }}
                </span>
            </div>
            
            <ul class="space-y-3">
                @foreach ($payments as $payment)
                    <li class="flex flex-col bg-slate-50 p-3 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-base font-semibold text-slate-800">
                                Amount: ₹{{ number_format($payment->amount, 2) }}
                            </span>
                            <span class="text-base font-semibold text-teal-600">
                                Status: {{ ucfirst($payment->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2 text-slate-600">
                            @if($payment->status == 'due' && $payment->due_date)
                                <span class="text-sm">Due Date: {{ $payment->due_date->format('d M, Y') }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-end">
                            @if($payment->status == 'due')
                                <form action="{{ route('students.processPayment', ['student' => $student->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $courseId }}">
                                    <input type="hidden" name="payment_option" value="{{ $paymentOption }}">
                                    <button type="submit" class="bg-teal-600 text-white text-xs px-3 py-1 rounded hover:bg-teal-700 transition">Pay Now</button>
                                </form>
                            @else
                                <span class="bg-green-600 text-white text-xs px-3 py-1 rounded">Paid</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>



            </div>
            
            
            <script>
                function resetForm() {
                    document.querySelector('form').reset();
                }
            </script>
            
            
        </div>
    </div>

    <script>
        function toggleEdit(field) {
            const valueSpan = document.getElementById(field + '-value');
            const form = document.getElementById(field + '-form');
            const isFormVisible = form.style.display === 'block';

            if (isFormVisible) {
                valueSpan.style.display = 'block';
                form.style.display = 'none';
            } else {
                valueSpan.style.display = 'none';
                form.style.display = 'block';
            }
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(event.target.id + '-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
