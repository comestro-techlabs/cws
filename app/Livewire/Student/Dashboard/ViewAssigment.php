<?php

namespace App\Livewire\Student\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Assignments;
use App\Models\Assignment_upload;
use Livewire\Attributes\Layout;


class ViewAssigment extends Component
{
    use WithFileUploads;

    public $assignment;
    public $uploadedFile;
    public $file;
    public $assignment_id;
    public $previewUrl; // Store the preview URL
    public $hasAccess = false; // Tracks if the user has access
    public $accessStatus = [];
    public $showAccessModal = false;

    public function mount($id)
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }

        $studentId = Auth::id();
        $this->hasAccess = $user->hasAccess();
        $this->accessStatus = $user->getAccessStatus();
        
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
        }
        // Fetch assignment details
        $this->assignment = Assignments::where('id', $id)
            ->whereHas('course', function ($query) use ($studentId) {
                $query->whereHas('users', function ($q) use ($studentId) {
                    $q->where('user_id', $studentId);
                });
            })->first();

        if (!$this->assignment) {
            return redirect()->back()->with('error', 'Assignment not found or access denied.');
        }

        $this->assignment_id = $this->assignment->id;
        if ($this->hasAccess) {
        // Fetch uploaded file
        $this->uploadedFile = Assignment_upload::where('student_id', $studentId)
            ->where('assignment_id', $id)
            ->first();

        // Generate preview URL
        $this->previewUrl = $this->getPreviewUrl();
    }
    }

    private function getPreviewUrl()
    {
        if ($this->uploadedFile) {
            $filePath = $this->uploadedFile->file_path; // File ID from Google Drive

            // Generate Google Drive Preview URL
            return "https://drive.google.com/file/d/$filePath/preview";
        }

        return null;
    }

    public function submit()
    {
        if (!$this->hasAccess) {
            session()->flash('error', 'You do not have access to submit assignments.');
            return;
        }
        $this->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        try {
            $accessToken = $this->token();

            // File details
            $file = $this->file;
            $mimeType = $file->getMimeType();
            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());

            // Upload file metadata to Google Drive
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

            // Upload file content
            $uploadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => $mimeType,
            ])->withBody($fileContent, $mimeType)->put($uploadUrl);

            if ($uploadResponse->successful()) {
                // Get file ID from Google Drive
                $fileId = json_decode($uploadResponse->body())->id;

                // Save file details in the database
                $assignment_upload = new Assignment_upload();
                $assignment_upload->student_id = auth()->id();
                $assignment_upload->file_path = $fileId;
                $assignment_upload->assignment_id = $this->assignment_id;
                $assignment_upload->submitted_at = now();
                $assignment_upload->status = 'submitted';
                $assignment_upload->save();

                // Generate new preview link
                $this->previewUrl = $this->getPreviewUrl();

                if ($this->assignment->isOverdue()) {
                    session()->flash('warning', 'Assignment submitted after due date.');
                } else {
                    session()->flash('success', 'Assignment submitted successfully.');
                }
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to upload assignment: ' . $e->getMessage());
        }
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
            'previewUrl' => $this->previewUrl, // Pass preview URL to the view
            
            'hasAccess' => $this->hasAccess,
            'accessStatus' => $this->accessStatus
        ]);
    }
}