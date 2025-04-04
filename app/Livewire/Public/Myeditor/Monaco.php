<?php

namespace App\Livewire\Public\Myeditor;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Monaco extends Component
{
    public $code = "// Write your code here";
    public $output = '';
    public $selectedLanguage = 'javascript';

    public function mount()
    {
        // Initialize with default language
        $this->selectedLanguage = 'javascript';
    }

    public function run()
    {
        $this->output = $this->executeCode($this->code, $this->selectedLanguage);
    }

    public function save()
    {
        Storage::put("code/{$this->selectedLanguage}.txt", $this->code);
        session()->flash('message', 'Code saved successfully!');
    }

    public function updatedSelectedLanguage()
    {
        // Dispatch language change event for Livewire 3
        $this->dispatch('languageChanged', language: $this->selectedLanguage);
    }

    public function handleCodeUpdate($code)
    {
        $this->code = $code;
    }

    private function executeCode($code, $language)
    {
        try {
            if ($language === 'javascript') {
                $tempFile = storage_path('app/code.js');
                file_put_contents($tempFile, $code);
                $result = shell_exec("node $tempFile 2>&1");
                unlink($tempFile);
                return $result ?: "No output";
            }

            if ($language === 'php') {
                $tempFile = storage_path('app/code.php');
                file_put_contents($tempFile, "<?php\n" . $code);
                $result = shell_exec("php $tempFile 2>&1");
                unlink($tempFile);
                return $result ?: "No output";
            }

            if ($language === 'python') {
                $tempFile = storage_path('app/code.py');
                file_put_contents($tempFile, $code);
                $result = shell_exec("python3 $tempFile 2>&1");
                unlink($tempFile);
                return $result ?: "No output";
            }

            if ($language === 'html' || $language === 'css') {
                // Display HTML/CSS as plain code
                return htmlentities($code);
            }

        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

        return "Unsupported language";
    }
    public function render()
    {
        return view('livewire.public.myeditor.monaco');
    }
}
