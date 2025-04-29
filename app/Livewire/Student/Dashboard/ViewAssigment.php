<?php

namespace App\Livewire\Student\Dashboard;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Assignments;
use App\Models\Assignment_upload;
use Livewire\Attributes\Layout;
use App\Services\GemService;

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
            $filePath = $this->uploadedFile->file_path;
    
            // Log the file path and S3 configuration
            \Log::info('Generating S3 URL', [
                'file_path' => $filePath,
                's3_bucket' => config('filesystems.disks.s3.bucket'),
            ]);
    
            // Generate S3 file URL
            return Storage::disk('s3')->url($filePath);
        }
    
        return null;
    }

    private function checkConsecutiveSubmissions($studentId)
    {
       $submissions = Assignment_upload::where('student_id', $studentId)
                    ->orderBy('submitted_at', 'desc')
                    ->take(7)
                    ->get();

        if($submissions->count() < 7){
            return false;
        }

        foreach ($submissions as $submission){
            $assignment = Assignments::find($submission->assignment_id);
            if(!$assignment || $submission->submitted_at > $assignment->due_date){
                return false;
            }
        }
        $missedAssignments = Assignments::where('due_date', '<', now())
        ->whereDoesntHave('uploads', function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        })
        ->whereHas('course', function ($query) use ($studentId) {
            $query->whereHas('users', function ($q) use ($studentId) {
                $q->where('user_id', $studentId);
            });
        })
        ->where('due_date', '>=', $submissions->last()->submitted_at)
        ->exists();

        if ($missedAssignments) {
            return false;
        }
        return true;
    }

    public function submit()
{
    if (!$this->hasAccess) {
        session()->flash('error', 'You do not have access to submit assignments.');
        return;
    }

    // Check if the student has already submitted
    $existingSubmission = Assignment_upload::where('student_id', auth()->id())
        ->where('assignment_id', $this->assignment_id)
        ->first();

    if ($existingSubmission) {
        session()->flash('error', 'You have already submitted this assignment.');
        return;
    }

    $this->validate([
        'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    try {
        // File details
        $file = $this->file;
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = "assignments/{$fileName}";

        // Upload file to S3
        $fileContent = file_get_contents($file->getRealPath());
        Storage::disk('s3')->put($filePath, $fileContent, 'public');

        // Save file details in the database
        $assignment_upload = new Assignment_upload();
        $assignment_upload->student_id = auth()->id();
        $assignment_upload->file_path = $filePath; // Store S3 file path
        $assignment_upload->assignment_id = $this->assignment_id;
        $assignment_upload->submitted_at = now();
        $assignment_upload->status = 'submitted';
        $assignment_upload->save();

        // Update the uploadedFile property
        $this->uploadedFile = $assignment_upload;

        // Generate new preview link
        $this->previewUrl = $this->getPreviewUrl();

        // Handle gem awards
        $studentId = auth()->id();
        $gemService = new GemService();

        if ($this->assignment->isOverdue()) {
            session()->flash('warning', 'Assignment submitted after due date.');
        } else {
            $gemService->earnedGem(10, 'Earned By Submitting Assignment.');

            if ($this->checkConsecutiveSubmissions($studentId)) {
                $gemService->earnedGem(100, 'Bonus for completing 7 consecutive on-time assignments!');
                session()->flash('success', 'Assignment submitted successfully. You earned 10 gems plus 100 bonus gems for completing 7 assignments on time!');
            } else {
                session()->flash('success', 'Assignment submitted successfully. You earned 10 gems!');
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