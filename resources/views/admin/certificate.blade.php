@extends('admin.base')
@section('content')
<div class="flex flex-wrap justify-between items-center p-4">
    <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Certificate Eligibility</h2>
</div>
    <div class="container mt-5">
        <div class="overflow-x-auto">
            @if(count($userData)>0)
        <table class="table-auto border-collapse border border-gray-300 w-full ">
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
                           
                                <a href="{{ route('admin.viewCertificate', ['userId' => $data['id']]) }}" class="p-2 bg-green-100 text-green-700 rounded inline-block">
                                    🎉 <strong>Eligible</strong>
                                </a>
                           
                        </td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
      @else
        <p class="text-center text-red-500 mt-4">❌ only eligible candidates found.</P>
            @endif
        </div>
    </div>
@endsection
