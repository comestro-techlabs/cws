@extends('admin.base')

@section('title', 'Add Assignment | ')

@section('content')
<div class="col-span-1 md:col-span-6">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Batches </h1>
    {{-- {{dd($batches)}} --}}
        @if($batches->isEmpty())
            <p class="text-gray-600">No batches available for this course.</p>
        @else
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Batch Name</th>
                        <th class="border border-gray-300 px-4 py-2">Start Date</th>
                        <th class="border border-gray-300 px-4 py-2">End Date</th>
                        <th class="border border-gray-300 px-4 py-2">Total Seats</th>
                        <th class="border border-gray-300 px-4 py-2">Available Seats</th>
                        <th class="border border-gray-300 px-4 py-2">Students Enrolled</th>

                        <th class="border border-gray-300 px-4 py-2">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($batches as $batch)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $batch->batch_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($batch->start_date)->timezone('Asia/Kolkata')->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($batch->end_date)->timezone('Asia/Kolkata')->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $batch->total_seats }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $batch->available_seats }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $batch->users_count }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('batches.students', $batch->id) }}" class="text-blue-500 hover:underline">
                                    View Students
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>  
</div>
@endsection
