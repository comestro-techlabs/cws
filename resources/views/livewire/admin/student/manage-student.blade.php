<div>
    <div class="mx-auto">


        <div class="w-full flex justify-between items-center mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800"> {{ $search ? $search : 'Manage all' }} students ({{ $students->total() }})</h3>
            </div>
            <div class="ml-3">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    {{-- <div class="relative">
                        <input
                            class="bg-white w-full pr-11 h-10 pl-3 py-2  placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
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
                    </div> --}}
                    <div class="md:px-[2%] px-5 py-5">
                        <div class="flex gap-3 flex-col md:flex-row justify-between md:items-center">
                            
                            <div class="inline-flex md:flex-row flex-col  md:items-center gap-2" role="group">
                                <select wire:model.live="filter" class="border-slate-200 rounded-lg px-3 py-2">
                                    <option value="">Filter by</option>
                                    <option value="member">Member</option>
                                    <option value="user">User</option>
                                    <option value="status_active">Active</option>
                                    <option value="status_inactive">Inactive</option>
                                </select>
                            </div>
                                    <input type="search" wire:model.live="search"
                            class="bg-white w-full  h-10 py-2 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search by name..."
                        />
                        </div>
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
                                ID
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Full Name
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Email
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Contact
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Education Qualification
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Gender
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Is Member
                            </p>
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50">
                            <p class="text-sm font-normal leading-none text-slate-500">
                                Action
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                       
                        <td class="p-4 py-5">
                            <p class="block font-semibold text-sm text-slate-800">{{ $student->id }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $student->name }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $student->email }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $student->contact }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $student->education_qualification }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">{{ $student->gender }}</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500"><span class="{{ $student->is_member == 1 ? 'bg-green-500 px-3 py-1 rounded-xl text-white' : 'bg-red-500 px-3 py-1 rounded-xl text-white' }}">
                                {{ $student->is_member == 1 ? 'Yes' : 'No' }}
                            </span></p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">
                                <a href="{{ route('admin.student.view', ['id' => $student->id]) }}"
                                    class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500">
                                    Show
                                </a>
                            </p>
                        </td>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No students found.</td>
                        </tr>
                    @endforelse
                    </tr>
                    
                </tbody>
            </table>
            <div class="flex justify-between items-center px-4 py-3">
                <div class="text-sm text-slate-500">
                    Showing 
                    <b>{{ $students->firstItem() }}-{{ $students->lastItem() }}</b> 
                    of {{ $students->total() }}
                </div>
                
                <div class="flex space-x-1">
                    <button 
                        wire:click="previousPage" 
                        wire:loading.attr="disabled"
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $students->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                    >
                        Prev
                    </button>
                    @foreach($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                        <button 
                            wire:click="gotoPage({{ $page }})"
                            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $students->currentPage() === $page ? 'text-white bg-slate-800 border-slate-800 hover:bg-slate-600 hover:border-slate-600' : 'text-slate-500 bg-white border-slate-200 hover:bg-slate-50 hover:border-slate-400' }} border rounded transition duration-200 ease"
                        >
                            {{ $page }}
                        </button>
                    @endforeach
                    <button 
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease {{ $students->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}"
                    >
                        Next
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    

</div>
