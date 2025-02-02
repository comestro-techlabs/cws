@extends('admin.base')

@section('title', 'Dashboard | ')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
    <!-- Admissions Card -->
    {{-- <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-orange-600 text-orange shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl text-orange-600 font-bold">{{ $admissionsCount }}</p>
            <h3 class="text-lg text-orange-600 font-semibold">Admissions</h3>
        </div>
        <a href="#" class="text-sm text-blue-600 hover:underline">View Details</a>
    </div> --}}

    <!-- Students Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-green-600 text-green-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $studentsCount }}</p>
            <h3 class="text-lg text-green-600 font-semibold">Students</h3>
        </div>
        <a href="{{ route('student.manage') }}" class="text-sm text-green-600 hover:underline">View Details</a>
    </div>

    <!-- Categories Card -->
    {{-- <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-pink-600 text-pink-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $categoriesCount }}</p>
            <h3 class="text-lg text-pink-600 font-semibold">Categories</h3>
        </div>
        <a href="#" class="text-sm text-pink-600 hover:underline">View Details</a>
    </div> --}}

    <!-- Courses Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-yellow-600 text-yellow-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $coursesCount }}</p>
            <h3 class="text-lg text-yellow-600 font-semibold">Courses</h3>
        </div>
        <a href="{{ route('course.index') }}" class="text-sm text-yellow-600 hover:underline">View Details</a>
    </div>

    <!-- Batches Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-blue-600 text-blue-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $batchesCount }}</p>
            <h3 class="text-lg text-blue-600 font-semibold">Batches</h3>
        </div>
        <a href="#" class="text-sm text-blue-600 hover:underline">View Details</a>
    </div>

    <!-- Lessons Card -->
    {{-- <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-purple-600 text-purple-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $lessonsCount }}</p>
            <h3 class="text-lg text-purple-600 font-semibold">Lessons</h3>
        </div>
        <a href="#" class="text-sm text-purple-600 hover:underline">View Details</a>
    </div> --}}

    <!-- Chapters Card -->
    {{-- <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-teal-600 text-teal-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $chaptersCount }}</p>
            <h3 class="text-lg text-teal-600 font-semibold">Chapters</h3>
        </div>
        <a href="#" class="text-sm text-teal-600 hover:underline">View Details</a>
    </div> --}}

    <!-- Payments Card -->
     <!-- <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-green-800 text-green-800 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $paymentsCount }}</p>
            <h3 class="text-lg text-green-800 font-semibold">Payments</h3>
        </div>
        <a href="{{route('admin.manage-payment')}}" class="text-sm text-green-800 hover:underline">View Details</a>
    </div>  -->

    <div class="bg-gradient-to-r from-slate-100 to-slate-200 border-l-4 border-green-800 text-green-800 shadow-xl rounded-lg p-6 flex flex-col justify-between h-[200px]">
    <!-- Total Payments at the Top -->
    <div class="text-center">
        <h3 class="text-lg font-semibold">Total Payments</h3>
        <p class="text-4xl font-bold">{{ $paymentsCount }}</p>
    </div>

    <!-- Current & Previous Month Payments -->
    <div class="flex justify-between mt-4">
        <div class="text-left">
            <h3 class="text-md font-semibold">Current Month</h3>
            <p class="text-2xl font-bold">{{ $currentMonthAmount }}</p>
        </div>
        <div class="text-right">
            <h3 class="text-md font-semibold">Previous Month</h3>
            <p class="text-2xl font-bold">{{ $previousMonthAmount }}</p>
        </div>
    </div>

    <!-- View Details Link -->
    <a href="{{ route('admin.manage-payment') }}" class="text-sm font-semibold hover:underline text-right mt-3">
        View Details →
    </a>
</div>
<!-- total overdue -->
<div class="bg-gradient-to-r from-slate-100 to-slate-200 border-l-4 border-green-800 text-green-800 shadow-xl rounded-lg p-6 flex flex-col justify-between h-[200px]">
    <!-- Total overduePayments at the Top -->
    <div class="text-center">
        <h3 class="text-lg font-semibold">Total Overdue Payments</h3>
        <p class="text-4xl font-bold">{{ $overdueCount }}</p>
    </div>

    <!-- Current & Previous Month Payments -->
    <div class="flex justify-between mt-4">
        <div class="text-left">
            <h3 class="text-md font-semibold">Current Month</h3>
            <p class="text-2xl font-bold">{{ $currentMonthOverdue }}</p>
        </div>
        <div class="text-right">
            <h3 class="text-md font-semibold">Previous Month</h3>
            <p class="text-2xl font-bold">{{ $previousMonthAmount }}</p>
        </div>
    </div>

    <!-- View Details Link -->
    <a href="{{ route('admin.manage-payment') }}" class="text-sm font-semibold hover:underline text-right mt-3">
        View Details →
    </a>
</div>
  
    

    <!-- Due Payments Card -->
    {{-- <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-indigo-600 text-indigo-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $duePaymentsCount }}</p>
            <h3 class="text-lg text-indigo-600 font-semibold">Due Payments</h3>
        </div>
        <a href="#" class="text-sm text-indigo-600 hover:underline">View Details</a>
    </div> --}}
</div>


@endsection
