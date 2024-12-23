@extends('admin.base')

@section('title', 'Add assignment | ')

@section('content')
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-2 ">
            Manage Assignments
        </h2>
        <a href="{{ route('assignment.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0">
            Create New Assignment
            <i class="bi bi-arrow-down-short font-bold"></i>
        </a>
    </div>

    <div class="flex justify-between p-2">
        <div class="w-full bg-white p-6 shadow-md rounded-lg">



            <!-- Table displaying existing assignments -->
            <div class="overflow-x-auto flex-wrap">
                <table class="min-w-full table-auto mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border">Student</th>
                            <th class="px-4 py-2 text-left  border">Assignment</th>
                            <th class="px-4 py-2 text-left  border">isSubmited</th>
                            <th class="px-4 py-2 text-left  border">course</th>
                            <th class="px-4 py-2 text-left  border">submitted_at(date)</th>
                            <th class="px-4 py-2 text-left  border">download/view</th>
                            <th class="px-4 py-2 text-left  border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{dd($assignmnetUploads)}} --}}
                        @foreach ($fileData as $item)
                            <tr>

                                <td class="px-4 py-2 truncate max-w-20 border">{{ $item['user'] }}</td>
                                <td class="px-4 py-2 truncate max-w-20 border">{{ $item['name'] }}</td>
                                <td class="px-4 py-2 truncate max-w-20 border">{{ $item['status'] }}</td>
                                <td class="px-4 py-2 truncate max-w-20 border">{{ $item['course'] }}</td>
                                {{-- {{dd($item)}} --}}
                                <td class="px-4 py-2 border">
                                    {{ \Carbon\Carbon::parse($item['submitted_at'])->format('d M Y') }}
                                </td>
                                {{-- <td class="px-4 py-2 border">
                                    <div class="flex bg-orange-500  rounded-sm shadow">
                                        <a href="https://drive.google.com/file/d/{{ $item['id'] }}/view" target="_blank"
                                            class=" text-white px-3 py-1 ">
                                            show
                                        </a>
                                        <a href="{{ route('assignments.download', $item['id']) }}"><img width="40"
                                                height="40" src="https://img.icons8.com/windows/32/download--v1.png"
                                                alt="download--v1" /></a>

                                    </div>
                                </td> --}}
                                <td class="px-4 py-2 border">
                                    <div class="flex bg-orange-500 rounded-sm shadow">
                                        <button onclick="openDocument('{{ $item['id'] }}')" class="text-white px-3 py-1">
                                            Show
                                        </button>
                                        {{-- <a href="{{ route('assignments.download', $item['id']) }}">
                                            <img width="40" height="40" src="https://img.icons8.com/windows/32/download--v1.png" alt="download--v1" />
                                        </a> --}}
                                    </div>
                                </td>
                                <td class="px-4 py-2 border">view</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- modal -->

            <div id="documentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg p-4 w-3/4 h-3/4">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-bold">Document Viewer</h2>
                        <button onclick="closeDocument()" class="text-red-500 font-bold">X</button>
                    </div>
                    <iframe id="docViewer" class="w-full h-full border rounded-lg"></iframe>
                </div>
            </div>
            

        </div>
    </div>
    </div>
    <script>
        function openDocument(docId) {
            const docUrl = `https://drive.google.com/file/d/${docId}/preview`;
            document.getElementById('docViewer').src = docUrl;
            document.getElementById('documentModal').classList.remove('hidden');
        }
    
        function closeDocument() {
            document.getElementById('docViewer').src = '';
            document.getElementById('documentModal').classList.add('hidden');
        }
    </script>
@endsection
