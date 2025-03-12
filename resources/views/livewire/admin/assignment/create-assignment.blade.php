<div class="min-h-screen">
    <div class="mx-auto p-6">
        <div class="flex flex-wrap justify-between items-center p-4">
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">
                {{ $assignment ? 'Edit Assignment' : 'Create Assignment' }}
            </h2>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form wire:submit.prevent="save" class="space-y-6">
                <!-- Assignment Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Assignment Title</label>
                    <input type="text" wire:model="title" id="title"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter assignment name">
                    @error('title')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Instructions with CKEditor -->
                <div wire:ignore>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Instructions
                        (Optional)</label>
                    <textarea id="description" wire:model.debounce.500ms="description" rows="4"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 h-32 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter instructions"></textarea>
                    @error('description')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Course Selection -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Select Course</label>
                    <select wire:model.live="course_id" id="course_id" wire:change="updateBatches"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                        <option value="">Select a course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div wire:target="updateBatches">
                    <label for="batch_id" class="block text-sm font-medium text-gray-700 mb-2">Select Batch</label>
                    <select wire:model="batch_id" id="batch_id"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                        <option value="">Select a batch</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                        @endforeach
                    </select>
                    @error('batch_id')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end text-center gap-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="bg-purple-800 text-white px-6 py-3 rounded-md shadow hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50">
                        <span wire:loading.remove>{{ $assignment ? 'Update Assignment' : 'Create Assignment' }}</span>
                        <span wire:loading>{{ $assignment ? 'Updating...' : 'Creating...' }}</span>
                    </button>
                    <a href="{{ route('admin.assignment.manage') }}" wire:navigate
                        class="bg-gray-800 text-white px-6 py-3 rounded-md shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50">
                        Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
    let editorInstance = null;

    document.addEventListener('DOMContentLoaded', () => {
        initializeCKEditor();
    });

    document.addEventListener('livewire:navigated', () => {
        setTimeout(() => {
            initializeCKEditor();
        }, 200); 
    });

    document.addEventListener('livewire:update', () => {
        setTimeout(() => {
            initializeCKEditor();
        }, 200);
    });

    function initializeCKEditor() {
        const descriptionElement = document.querySelector('#description');
        if (!descriptionElement) {
            console.log('Textarea #description not found');
            return;
        }

        if (editorInstance) {
            editorInstance.destroy()
                .then(() => {
                    editorInstance = null;
                    createEditor(descriptionElement);
                })
                .catch(error => {
                    console.error('Error destroying CKEditor:', error);
                    editorInstance = null;
                    createEditor(descriptionElement);
                });
            return; 
        }

        createEditor(descriptionElement);
    }

    function createEditor(element) {
        ClassicEditor
            .create(element, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo'
                ],
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                }
            })
            .then(editor => {
                editorInstance = editor;
                const initialData = @json($description) || '';
                editor.setData(initialData);

                editor.model.document.on('change:data', () => {
                    if (window.Livewire) {
                        @this.set('description', editor.getData());
                    }
                });
            })
            .catch(error => {
                console.error('CKEditor initialization failed:', error);
            });
    }

</script>
</div>