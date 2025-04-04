<div class="flex flex-col gap-4 mt-20 px-20">
    <!-- Language Selector -->
    <div class="flex items-center gap-2">
        <label for="language" class="font-semibold">Select Language:</label>
        <select wire:model="selectedLanguage" class="border p-2 rounded" id="language">
            <option value="javascript">JavaScript</option>
            <option value="php">PHP</option>
            <option value="python">Python</option>
            <option value="html">HTML</option>
            <option value="css">CSS</option>
        </select>
    </div>

    <!-- Monaco Editor Container -->
    <div id="editor-container" style="height: 400px; width: 100%;" wire:ignore></div>

    <div class="flex gap-2 mt-4">
        <button wire:click="run" class="bg-green-500 text-white px-4 py-2 rounded">Run Code</button>
        <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded">Save Code</button>
    </div>

    <div class="bg-gray-100 p-4 rounded shadow mt-4">
        <h3 class="text-lg font-semibold">Output:</h3>
        <pre class="bg-white p-4 rounded shadow text-sm">{{ $output }}</pre>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', () => {
        require.config({ paths: { vs: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.44.0/min/vs' } });

        require(['vs/editor/editor.main'], () => {

            // Initialize the Monaco Editor with Default Settings
            const initEditor = (language, code = '') => {
                const container = document.getElementById('editor-container');

                if (window.monacoEditor) {
                    window.monacoEditor.dispose();  // Dispose of previous editor instance
                }

                const editor = monaco.editor.create(container, {
                    value: code || `// Write your ${language} code here...`,  // Display default code
                    language: language,
                    theme: 'vs-dark',
                    automaticLayout: true  // Auto-resize the editor
                });

                // Listen for code changes
                editor.getModel().onDidChangeContent(() => {
                    Livewire.dispatch('codeUpdated', { code: editor.getValue() });
                });

                window.monacoEditor = editor;
            };

            // Initialize the editor with the selected language and existing code
            initEditor(@json($selectedLanguage), @json($code));

            // Listen for language changes
            Livewire.on('languageChanged', (event) => {
                initEditor(event.language, window.monacoEditor.getValue());
            });
        });
    });
</script>
