@extends('admin.base')

@section('title', 'Workshops')

@section('content')

<div class="flex flex-wrap justify-between items-center p-4">
    <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Workshops List</h2>
    <a href="{{ route('workshops.create') }}" class="px-4 py-2 bg-blue-500 text-white  rounded hover:bg-blue-600">
        Add New Workshops
    </a>
</div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fees
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                             Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($workshops as $workshop)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $workshop->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($workshop->time)->format('h:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <img src="{{ asset('storage/' . $workshop->image) }}" alt=""
                                        class="w-16 h-16 object-cover rounded-lg">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $workshop->fees }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($workshop->active)
                                        <form action="{{ route('workshops.toggleStatus', $workshop->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-2 py-1 text-white bg-green-500 rounded-md hover:bg-green-600">
                                                Active
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('workshops.toggleStatus', $workshop->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-2 py-1 text-white bg-red-500 rounded-md hover:bg-red-600">
                                                Inactive
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $workshop->payment ? $workshop->payment->payment_status : 'Pending' }}
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($workshop->payment)
                                        @if ($workshop->payment->payment_status == 'captured')
                                            <span class="px-2 py-1 text-white bg-green-500 rounded-md hover:bg-green-600">Successful</span>
                                        @elseif ($workshop->payment->payment_status == 'pending')
                                            <span class="px-2 py-1 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">Pending</span>
                                        @elseif ($workshop->payment->payment_status == 'failed')
                                            <span class="text-red-500">Failed</span>
                                        @else
                                            <span class="text-gray-500">Unknown</span>
                                        @endif
                                    @else
                                    <span class="px-2 py-1 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">Pending</span>
                                    @endif
                                </td>





                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{route('admin.workshops.edit', $workshop->id)}}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>


                                    <form action="{{route('admin.workshops.destroy',$workshop->id)}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 onclick="return confirm('Are you sure you want to delete this workshop?');">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
