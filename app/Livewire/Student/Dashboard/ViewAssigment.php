<?php

namespace App\Livewire\Student\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Assignments;
use App\Models\Assignment_upload;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

class ViewAssigment extends Component
{
    use WithFileUploads;

    public $assignment;
    public $uploadedFile;
    public $file;
    public $assignment_id;
    public $previewUrl;

    public function mount($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }
    
        $studentId = Auth::id();
    
        // Fetch assignment
        $this->assignment = Assignments::where('id', $id)
            ->whereHas('course', function ($query) use ($studentId) {
                $query->whereHas('users', function ($q) use ($studentId) {
                    $q->where('user_id', $studentId);
                });
            })->first();
    
        if (!$this->assignment) {
            return redirect()->back()->with('error', 'Assignment not found or access denied.');
        }
    
        // Fetch the uploaded file
        $this->uploadedFile = Assignment_upload::where('student_id', $studentId)
            ->where('assignment_id', $id)
            ->first();
    
        // Debugging: Check if file exists
        if ($this->uploadedFile) {
            \Log::info('File found: ' . $this->uploadedFile->file_path);
        } else {
            \Log::error('No file found for assignment ID: ' . $id);
        }
    
    }

    public function submit()
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        try {
            // Store file locally
            $filePath = $this->file->store('uploads', 'public');

            // Save file details to DB
            $assignment_upload = new Assignment_upload();
            $assignment_upload->student_id = auth()->id();
            $assignment_upload->file_path = $filePath;
            $assignment_upload->assignment_id = $this->assignment_id;
            $assignment_upload->submitted_at = now();
            $assignment_upload->status = 'submitted';
            $assignment_upload->save();

            // Upload to Google Drive
            $accessToken = $this->token();
            $file = $this->file;
            $mimeType = $file->getMimeType();
            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());

            $metadataResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=resumable', [
                'name' => $fileName,
                'mimeType' => $mimeType,
                'parents' => [config('services.google.folder_id')],
            ]);

            if (!$metadataResponse->successful()) {
                $this->addError('file', 'Failed to initialize upload.');
                return;
            }

            $uploadUrl = $metadataResponse->header('Location');

            $uploadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => $mimeType,
            ])->withBody($fileContent, $mimeType)->put($uploadUrl);

            if ($uploadResponse->successful()) {
                $fileId = json_decode($uploadResponse->body())->id;
                $assignment_upload->file_path = $fileId;
                $assignment_upload->save();
            }

            session()->flash('success', 'Assignment submitted successfully.');
            $this->previewUrl = $this->getPreviewUrl();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to upload assignment: ' . $e->getMessage());
        }
    }

    private function getPreviewUrl()
{
    if ($this->uploadedFile) {
        $filePath = asset('storage/' . $this->uploadedFile->file_path);
        $fileExtension = pathinfo($this->uploadedFile->file_path, PATHINFO_EXTENSION);

        if ($fileExtension === 'pdf') {
            return $filePath; // Direct link for PDF preview
        }

        if (in_array($fileExtension, ['doc', 'docx'])) {
            return "https://docs.google.com/gview?url=" . urlencode($filePath) . "&embedded=true";
        }
    }

    return null;
}


    private function token()
    {
        $client_id = config('services.google.client_id');
        $client_secret = config('services.google.client_secret');
        $refresh_token = config('services.google.refresh_token');

        $response = Http::post('https://oauth2.googleapis.com/token', [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token',
        ]);

        if ($response->successful()) {
            return json_decode($response->body(), true)['access_token'];
        }

        throw new \Exception('Failed to fetch access token');
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.view-assigment', [
            'previewUrl' => $this->previewUrl,
        ]);
    }
}
