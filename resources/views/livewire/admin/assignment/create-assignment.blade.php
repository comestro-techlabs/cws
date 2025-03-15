<div class="py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900">
                {{ $assignment ? 'Edit Assignment' : 'Create New Assignment' }}
            </h2>
            <p class="mt-2 text-gray-600">Fill in the details to {{ $assignment ? 'update' : 'create' }} an assignment</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form wire:submit.prevent="save" class="space-y-6">
                <!-- Course & Batch Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                        <select id="course_id" wire:model.live="course_id" class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="batch_id" class="block text-sm font-medium text-gray-700">Batch</label>
                        <select id="batch_id" wire:model="batch_id" @if(!$course_id) disabled @endif
                            class="mt-1 block w-full pl-3 pr-10 py-3 text-base border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 disabled:bg-gray-100">
                            <option value="">Select Batch</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Title & Due Date -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Assignment Title</label>
                        <input type="text" id="title" wire:model="title" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="datetime-local" id="due_date" wire:model="due_date" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        @error('due_date') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description with CKEditor -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div wire:ignore>
                        <textarea id="description" wire:model="description" 
                            x-data
                            x-init="
                                CKEDITOR.replace('description', {
                                    height: 300,
                                    toolbar: [
                                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
                                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                                        { name: 'links', items: [ 'Link', 'Unlink' ] },
                                        { name: 'insert', items: [ 'Table', 'HorizontalRule', 'SpecialChar' ] },
                                        { name: 'tools', items: [ 'Maximize' ] },
                                    ]
                                });
                                
                                CKEDITOR.instances.description.on('change', function() {
                                    @this.set('description', this.getData());
                                });
                            "
                        ></textarea>
                    </div>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Status Toggle -->
                <div class="flex items-center space-x-3">
                    <div class="flex items-center">
                        <input type="checkbox" id="status" wire:model="status" class="w-5 h-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                        <label for="status" class="ml-2 text-sm font-medium text-gray-700">Active Assignment</label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.assignment.manage') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-teal-600 text-white rounded-xl hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all">
                        {{ $assignment ? 'Update' : 'Create' }} Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    @endpush
</div>