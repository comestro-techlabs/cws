{{-- @extends('studentdashboard.include.base')

@section('content')

<div class="container-fluid page__container mt-24">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exam Completed</h5>
                    <p>You have completed the exam!</p>
                    <div class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Exam ID:</strong> {{ session('exam_id') ?? 'N/A' }}</p>
                                <p><strong>Total Marks:</strong> {{ $totalMarks  }}</p>
                                <p><strong>Obtained Marks:</strong> {{ $obtainedMarks ?? '0' }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h6>Navigation</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('student.dashboard') }}"> 
                        <button class="btn btn-light btn-block mb-1">Return to Dashboard</button>
                    </a> 
                </div>
            </div>
        </div>
    </div>
</div>


@endsection --}}             



{{-- @extends('studentdashboard.include.base')


@section('content')
<div class="container mt-24">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Result for Attempt {{ $attempt }}</h2>
    <p>Total Marks: {{ $totalMarks }}</p>

    
</div>
@endsection --}}

@extends('studentdashboard.include.base')

@section('content')
<div class="container mt-24 px-4">
    @if (session('error'))
        <div class="alert alert-danger mb-4 bg-red-100 text-red-800 p-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="text-2xl font-semibold mb-4">Result for Attempt {{ $attempt }}</h2>
    <p class="text-lg mb-6"><strong>Total Marks:</strong> {{ $totalMarks }}</p>

    <h4 class="text-xl font-semibold mt-4">Detailed Feedback:</h4>
    <div class="result-details mb-6 p-4 border-l-4">
        @if ($attempt == 1)
            <p class="text-lg"><strong>Your first attempt was evaluated. </strong> <span class="text-gray-600">Good luck on your second attempt!</span></p>
        @elseif ($attempt == 2)
            <p class="text-lg"><strong>Congratulations! Your second attempt went well.</strong> You scored higher on this attempt.</p>
        @else
            <p class="text-lg"><strong>We recommend reviewing your results and trying again.</strong> Please check for any improvement areas.</p>
        @endif
    </div>

    
</div>
@endsection


