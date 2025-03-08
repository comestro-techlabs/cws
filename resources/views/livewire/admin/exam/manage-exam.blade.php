<div>
    <div class="container mx-auto px-4 sm:px-8 py-8">
        <div class="flex flex-col gap-8">
            <div class="w-full mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">Manage exams</h2>
                    <!-- Search and Create Section -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4  ">
                        <div class="w-full md:w-1/2 ">
                            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search exams..."
                                class="w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                        </div>
                        <button wire:click="toggleForm"
                            class="px-12 py-2 bg-purple-800 text-white rounded-lg hover:bg-purple-600">
                            {{ $showForm ? 'Cancel' : 'Create Exam' }}
                        </button>
                    </div>

                    <!-- Create/Edit Form -->
                    @if ($showForm)
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Exam' : 'Create New Exam' }}
                            </h3>
                            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Exam Name</label>
                                        <input wire:model="exam_name" type="text"
                                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 ">
                                        @error('exam_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Course</label>
                                        <select wire:model.change="course_id"
                                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 ">
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Batch</label>
                                        <select wire:model.change="batch_id"
                                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 "
                                            {{ !$course_id ? 'disabled' : '' }}>
                                            <option value="">Select Batch</option>
                                           
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('batch_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                   
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Exam Date</label>
                                        <input wire:model="exam_date" type="date"
                                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 ">
                                        @error('exam_date')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-2">
                                        <label class="flex items-center">
                                            <input wire:model="status" type="checkbox"
                                                class="rounded border border-gray-300 text-blue-600">
                                            <span class="ml-2">Active</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end space-x-3">
                                    <button type="button" wire:click="toggleForm"
                                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-purple-800 text-white rounded-lg hover:bg-blue-600">
                                        {{ $isEditing ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif


                    @if (session()->has('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Exams Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Exam Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Course</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Batch</th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Exam Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($exams as $exam)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $exam->exam_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $exam->course->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $exam->batch->batch_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $exam->exam_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <button wire:click="toggleStatus({{ $exam->id }})"
                                                class="px-3 py-1 rounded-full text-sm {{ $exam->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $exam->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td class=" flex gap-2 px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <button wire:click="edit({{ $exam->id }})"
                                                class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-500 transition flex items-center gap-1">Edit <i class="bi bi-pencil-square"></i></button>
                                            <button wire:click="delete({{ $exam->id }})"
                                                class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500 flex items-center gap-1"
                                                onclick="return confirm('Are you sure you want to delete this exam?')">
                                                Delete <i class="bi bi-trash3-fill font-bold"></i>
                                            </button>
                                        <a href="{{route('admin.exam.questions', ['examId' => $exam->id])}}" wire:navigate class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-purple-800 transition flex items-center gap-1">Questions <i class="bi bi-pencil-square')}}"></a>
                                           
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No Exam
                                            found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-between items-center px-4 py-3">
                        <div class="text-sm text-gray-500">
                            Showing
                            <b>{{ $exams->firstItem() }}-{{ $exams->lastItem() }}</b>
                            of {{ $exams->total() }}
                        </div>
                        <div class="flex space-x-1">
                            <button wire:click="previousPage" wire:loading.attr="disabled"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $exams->onFirstPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Prev
                            </button>
                            @foreach ($exams->getUrlRange(1, $exams->lastPage()) as $page => $url)
                                <button wire:click="gotoPage({{ $page }})"
                                    class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal {{ $exams->currentPage() === $page ? 'text-white bg-gray-800 border-gray-800 hover:bg-gray-600 hover:border-gray-600' : 'text-gray-500 bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-400' }} border rounded transition duration-200 ease">
                                    {{ $page }}
                                </button>
                            @endforeach
                            <button wire:click="nextPage" wire:loading.attr="disabled"
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-gray-500 bg-white border border-gray-200 rounded hover:bg-gray-50 hover:border-gray-400 transition duration-200 ease {{ $exams->onLastPage() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Next
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('batches-updated', () => {
        });
    });
</script>
