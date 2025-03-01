<div class="container mx-auto px-4 sm:px-8 py-8">
    <div class="flex flex-col gap-8">
        <div class="w-full mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Manage Students</h2>
                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="flex-1">
                        <input type="search" wire:model.live="search" class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2" placeholder="Search by name...">
                    </div>
                    <div class="flex-1">
                        <select wire:model.live="filter" class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                            <option value="">Filter by</option>
                            <option value="member">Member</option>
                            <option value="user">User</option>
                            <option value="status_active">Active</option>
                            <option value="status_inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Education Qualification</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Member</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($students as $student)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->contact }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->education_qualification }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->gender }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="{{ $student->is_member == 1 ? 'bg-green-500 px-3 py-1 rounded-xl text-white' : 'bg-red-500 px-3 py-1 rounded-xl text-white' }}">
                                            {{ $student->is_member == 1 ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.student.view', ['id' => $student->id]) }}" class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500 hover:bg-teal-600">
                                            Show
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-gray-500">
                        Showing
                        <b>{{ $students->firstItem() }}-{{ $students->lastItem() }}</b>
                        of {{ $students->total() }}
                    </div>
                    <div class="flex space-x-1">
                        <button
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $students->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        >
                            Prev
                        </button>
                        @foreach($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                            <button
                                wire:click="gotoPage({{ $page }})"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $students->currentPage() === $page ? 'text-white bg-gray-800 border-gray-800 hover:bg-gray-600 hover:border-gray-600' : 'text-gray-500 bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-400' }} border rounded transition duration-200 ease"
                            >
                                {{ $page }}
                            </button>
                        @endforeach
                        <button
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $students->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
