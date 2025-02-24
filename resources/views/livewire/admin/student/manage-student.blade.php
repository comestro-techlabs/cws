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
                                <a href=""
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
