


@extends('admin.base')

@section('title', 'Add Assignment | ')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Students in Batch: {{ $batch->batch_name }}</h1>

    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Phone</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $key => $student)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $student->contact ?? 'Null' }}</td>
                    <td class="border border-gray-300 px-4 py-2">

                        <a href="{{ route('student.edit', $student->id) }}" class="bg-teal-400 px-2 py-1 rounded-lg text-white">show</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                        No students enrolled in this batch.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection