<div>
    <div class="mx-auto">


        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Projects with Invoices</h3>
                <p class="text-slate-500">Overview of the current activities.</p>
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <div class="relative">
                        <input
                            class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search for invoice..."
                        />
                        <button
                            class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                            type="button"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Invoice Number
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Customer
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Amount
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Issued
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Due Date
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                            <p class="block font-semibold text-sm text-slate-800">PROJ1001</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">John Doe</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">$1,200.00</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-01</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-15</p>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                            <p class="block font-semibold text-sm text-slate-800">PROJ1002</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">Jane Smith</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">$850.00</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-05</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-20</p>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                            <p class="block font-semibold text-sm text-slate-800">PROJ1003</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">Acme Corp</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">$2,500.00</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-07</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-21</p>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                            <p class="block font-semibold text-sm text-slate-800">PROJ1004</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">Global Inc</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">$4,750.00</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-10</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">2024-08-25</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-between items-center px-4 py-3">
                <div class="text-sm text-slate-500">
                    Showing <b>1-5</b> of 45
                </div>
                <div class="flex space-x-1">
                    <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                        Prev
                    </button>
                    <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 border border-slate-800 rounded hover:bg-slate-600 hover:border-slate-600 transition duration-200 ease">
                        1
                    </button>
                    <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                        2
                    </button>
                    <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                        3
                    </button>
                    <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-1 flex-col">
        <div class="md:px-[2%] px-5 py-5">
            <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center">
                <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-900 pl-3">
                    {{ $search ? $search : 'Manage all' }} students ({{ $students->total() }})
                </h2>
                <div class="inline-flex md:flex-row flex-col md:items-center gap-2" role="group">
                    <select wire:model.live="filter" class="border rounded-lg px-3 py-2">
                        <option value="">Filter by</option>
                        <option value="member">Member</option>
                        <option value="user">User</option>
                        <option value="status_active">Active</option>
                        <option value="status_inactive">Inactive</option>
                    </select>

                    <div class="flex border rounded-lg ps-3">
                        <input type="search" wire:model.live="search"
                            class="border-0 focus:outline-none focus:border-none w-full"
                            placeholder="Search student by name, mobile, or email..." />
                        <button class="bg-slate-100 px-3">
                            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto flex-1 border mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Id</th>
                        <th class="px-6 py-3">Full Name</th>
                        <th class="px-6 py-3">Contact</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Education Qualification</th>
                        <th class="px-6 py-3">Gender</th>
                        <th class="px-6 py-3">DOB</th>
                        <th class="px-6 py-3">Is Member</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{ $student->id }}</td>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->contact }}</td>
                            <td class="px-6 py-4">{{ $student->email }}</td>
                            <td class="px-6 py-4">{{ $student->education_qualification }}</td>
                            <td class="px-6 py-4">{{ $student->gender }}</td>
                            <td class="px-6 py-4">{{ $student->dob }}</td>
                            <td class="px-6 py-4">
                                <span class="{{ $student->is_member == 1 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $student->is_member == 1 ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="flex gap-2 items-center px-6 py-4">
                                <a href="{{ route('admin.student.view', ['id' => $student->id]) }}"
                                    class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500">
                                    Show
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-1 space-x-2 justify-center mt-2 pagination">
            {{ $students->links() }}
        </div>
    </div>

</div>
