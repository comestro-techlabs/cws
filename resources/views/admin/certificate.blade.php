@extends('admin.base')
@section('content')
    <div class="container mt-5">
        <h1 class="text-xl font-bold mb-4">Certificate Eligibility</h1>
        
        <table class="table-auto border-collapse border border-gray-300 w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Exam Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Assignment Total Marks</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Exam Total Marks</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Percentage</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Eligibility Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userData as $data)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['name'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['examName'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['assignmentTotal'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['examTotal'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($data['percentage'], 2) }}%</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($data['percentage'] >= 75)
                                <a href="{{ route('admin.viewCertificate', ['userId' => $data['id']]) }}" class="p-2 bg-green-100 text-green-700 rounded inline-block">
                                    🎉 <strong>Eligible</strong>
                                </a>
                            @else
                                <span class="p-2 bg-red-100 text-red-700 rounded inline-block">
                                    ❌ Not Eligible
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
