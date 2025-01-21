@extends('admin.base')

@section('content')
    <div class="container mt-5">
        <h1 class="text-xl font-bold mb-4">Certificate Eligibility</h1>
        
        <table class="table-auto border-collapse border border-gray-300 w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Criteria</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Name</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Exam Name</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $examName }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Assignment Total Marks</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $assignmentTotal }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Exam Total Marks</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $examTotal }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Total Marks</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $totalMarks }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Percentage</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($percentage, 2) }}%</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            @if($percentage >= 75)
                
                <a href="{{ route('admin.viewCertificate', ['userId' => $user->id]) }}"  class="p-4 bg-green-100 text-green-700 rounded-lg inline-flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8l-8 8-8-8" />
                    </svg>
                    <span>🎉 <strong>Congratulations!</strong> You are eligible for a certificate.</span>
                </a>
                
            @else
                <p class="p-4 bg-red-100 text-red-700 rounded-lg">
                    ❌ Sorry, you need at least 75% to qualify for a certificate.
                </p>
            @endif
        </div>
    </div>
@endsection
