@extends('admin.base')

@section('content')
    <div class="container">
        <h1>Purchased Courses for {{ $user->name }}</h1>

        @if ($user->payments->isNotEmpty())
            <ul>
                @foreach ($user->payments->groupBy('course_id') as $courseId => $payments)
                    <li>
                        <h3>Course: {{ $payments->first()->course->name }}</h3> 
                        <p>Description: {{ $payments->first()->course->description }}</p> 

                        <h4>Payments:</h4>
                        <ul>
                            @foreach ($payments as $payment)
                                <li>
                                    Amount Paid: {{ $payment->amount }} <br>
                                    Payment Date: {{ $payment->payment_date }} <br>
                                    Status: {{ ucfirst($payment->payment_status) }}
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No courses purchased yet.</p>
        @endif
    </div>
@endsection
