@extends('admin.base')

@section('title', 'Dashboard | ')

@section('content')
<div></div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">


    <!-- Students Card -->
    <div class="bg-gradient-to-r bg-slate-100 border-l-4 border-green-600 text-green-600 shadow-xl rounded-lg p-4 flex flex-col justify-between" style="height: 130px;">
        <div>
            <p class="text-3xl font-bold">{{ $studentsCount }}</p>
            <h3 class="text-lg text-green-600 font-semibold">Students</h3>
        </div>
        <a href="{{ route('student.manage') }}" class="text-sm text-green-600 hover:underline">View Details</a>
    </div>
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
    <!-- Chapters Card -->

    <div class="bg-gradient-to-r from-slate-100 to-slate-200 border-l-4 border-green-800 text-green-800 shadow-xl rounded-lg px-6 py-3 flex flex-col justify-between h-[130px]">
    <!-- Total Payments at the Top -->
    <div class="text-start">
        <p class="text-2xl font-bold">₹{{ $paymentsCount }}</p>
        <h3 class="text-sm font-semibold">Total Payments</h3>
    </div>

    <!-- Current & Previous Month Payments -->
    <div class="flex justify-between mt-2 text-slate-400">
        <div class="text-left">
            <h3 class="text-xs font-lighter">Current Month</h3>
            <p class="text-xs font-lighter">₹{{ $currentMonthAmount }}</p>
        </div>
        <div class="text-right">
            <h3 class="text-xs font-lighter">Previous Month</h3>
            <p class="text-xs font-lighter">₹{{ $previousMonthAmount }}</p>
        </div>
    </div>
</div>
<!-- total overdue -->
<div class="bg-gradient-to-r from-slate-100 to-slate-200 border-l-4 border-red-500 text-red-500 shadow-xl rounded-lg px-6 py-3 flex flex-col justify-between h-[130px]">
    <!-- Total overduePayments at the Top -->
    <div class="text-start">
        <p class="text-2xl font-bold">₹{{ $overdueCount }}</p>
        <h3 class="text-sm font-semibold">Total Overdue Payments</h3>
    </div>

    <!-- Current & Previous Month Payments -->
    <div class="flex justify-between mt-4 text-slate-400">
        <div class="text-left ">
            <h3 class="text-xs font-lighter">Current Month</h3>
            <p class="text-xs font-lighter">₹{{ $currentMonthOverdue }}</p>
        </div>
        <div class="text-right">
            <h3 class="text-xs font-lighter">Previous Month</h3>
            <p class="text-xs font-lighter">₹{{ $previousMonthAmount }}</p>
        </div>
    </div>

</div>


</div>
<div class="flex  items-center mt-6">
    <div class="w-full h-auto md:w-1/2  bg-white shadow-lg rounded-lg p-4">
        <canvas id="myChart"></canvas>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var months = @json($monthlyPaymentsLabels);
var capturedData = @json($monthlyCapturedValues);
var overdueData = @json($monthlyOverdueValues);

var ctx = document.getElementById("myChart").getContext("2d");
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
            {
                label: "Overdue Payments",
                data: overdueData,
                backgroundColor: "rgba(255, 99, 132, 0.7)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 1
            },
            {
                label: "Captured Payments",
                data: capturedData,
                backgroundColor: "rgba(75, 192, 192, 0.7)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 1
            }
           
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endsection
