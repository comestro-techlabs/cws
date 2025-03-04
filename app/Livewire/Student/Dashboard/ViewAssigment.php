<?php

namespace App\Livewire\Student\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Assignments;
use App\Models\Assignment_upload;

class ViewAssigment extends Component
{
    use WithFileUploads;

    public $assignment; // The assignment being viewed
    public $uploadedFile; // The file already uploaded by the student (if any)
    public $file; // The file being uploaded
    public $assignment_id; // The ID of the assignment

    public function mount($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }

        $studentId = Auth::id();

        // Find the assignment with a relationship check for the student's course
        $this->assignment = Assignments::where('id', $id)
            ->whereHas('course', function ($query) use ($studentId) {
                $query->whereHas('users', function ($q) use ($studentId) {
                    $q->where('user_id', $studentId);
                });
            })->first();

        if (!$this->assignment) {
            return redirect()->back()->with('error', 'Assignment not found or access denied.');
        }

        // Set the assignment_id property
        $this->assignment_id = $this->assignment->id;

        // Check if the file has already been uploaded
        $this->uploadedFile = Assignment_upload::where('student_id', $studentId)
            ->where('assignment_id', $id)
            ->first();
    }

    public function submit()
    {
        // Validate the file
        $this->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // Adjust rules as needed
        ]);

        // Get the access token for Google Drive
        $accessToken = $this->token();

        // Prepare file details
        $file = $this->file;
        $mimeType = $file->getMimeType();
        $fileName = $file->getClientOriginalName();
        $fileContent = file_get_contents($file->getRealPath());

        // Step 1: Metadata request to Google Drive
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

        // Step 2: Upload file content to Google Drive
        $uploadResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => $mimeType,
        ])->withBody($fileContent, $mimeType)->put($uploadUrl);

        if ($uploadResponse->successful()) {
            // Get the file ID from Google Drive
            $fileId = json_decode($uploadResponse->body())->id;

            // Save the file details to the database
            $uploadedFile = new Assignment_upload();
            $uploadedFile->student_id = auth()->id();
            $uploadedFile->file_path = $fileId;
            $uploadedFile->assignment_id = $this->assignment_id; // Use the assignment_id property
            $uploadedFile->submitted_at = now(); // Set the submission time
            $uploadedFile->status = 'submitted';
            $uploadedFile->save();

            // Flash a success message
            session()->flash('msg', 'File uploaded to Google Drive successfully.');
        } else {
            $this->addError('file', 'Failed to upload file to Google Drive.');
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

    public function render()
    {
        return view('livewire.student.dashboard.view-assigment');
    }
}