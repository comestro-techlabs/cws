@extends('studentdashboard.include.base')

@section('content')

          <div class="container mt-24 px-4">
            <h2 class="text-2xl font-semibold mb-6">All Attempts for Course : {{ $course->title }}</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($attempts_data as $data)
                    <div class="card bg-white  rounded-lg p-4">
                        <div class="card-body">
                            <h5 class="text-lg font-semibold mb-2">Attempt {{ $data['attempt'] }}</h5>
                            <p class="text-md mb-2">
                                <strong>Total Marks:</strong> {{ $data['total_marks'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> 
@endsection



