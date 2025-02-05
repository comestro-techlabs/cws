@extends('admin.base')

@section('title', 'create placedstudent ')

@section('content')

<div class="flex flex-wrap justify-between items-center p-4">
    <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-orange-400 pl-3 mb-5">Manage Placed Student</h2>
    <a href="{{ route('placedStudent.create') }}" class="px-4 py-2 bg-blue-500 text-white  rounded hover:bg-blue-600">
        Add New Student
    </a>
</div>
    <div class="mx-auto p-3">
      
        @if (session('success'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border text-sm border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left ">Content</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Position</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($placedStudents as $key => $student)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $key + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $student->name }}</td>
                            <td class="border border-gray-300 px-4 py-2  md:line-clamp-none line-clamp-3">{{ $student->content }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $student->position }}</td>
                            {{-- <td class="border border-gray-300 px-4 py-2">{{ $student->status }}</td> --}}
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <form action="{{ route('placedStudent.toggleStatus', $student->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 text-white font-bold rounded
                                        {{ $student->status ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                                        {{ $student->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($student->image)
                                    <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}"
                                        class="w-16 h-16 rounded">
                                @else
                                    N/A 
                                @endif
                            </td>
                             <td class="border flex items-center gap-2 border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('placedStudent.edit', $student->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a> |
                                <form action="{{ route('placedStudent.destroy', $student->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                </form>
                            </td> 

                           
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
