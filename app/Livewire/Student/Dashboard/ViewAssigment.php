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
use App\Events\StudentAssignmentNotification;
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

    public function mount($id = null)
    {
        // If $id wasn't injected (BindingResolutionException scenario), try to
        // resolve it from the current request or route parameters. This handles
        // cases where the URL is like /student/view-assigment?81= or when JavaScript
        // tried to load the component without passing the parameter.
        if (is_null($id)) {
            $request = request();

            // Try common places: route parameter named id or assignment_id, or
            // any numeric query parameter (like ?81=) where key is empty/unknown.
            $id = $request->route('id') ?? $request->route('assignment') ?? $request->query('id') ?? $request->query('assignment_id');

            // If still null, scan query parameters and take the first numeric key or value.
            if (is_null($id)) {
                foreach ($request->query() as $key => $value) {
                    // If the key looks like a number (e.g. "81"), use it.
                    if (is_numeric($key)) {
                        $id = (int) $key;
                        break;
                    }

                    // If the value looks numeric, prefer that.
                    if (is_numeric($value)) {
                        $id = (int) $value;
                        break;
                    }
                }
            }
        }
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
            $fileName = time() . '_' . $this->file->getClientOriginalName();
            $filePath = "assignments/{$fileName}";

            // Upload to S3
            Storage::disk('s3')->put($filePath, file_get_contents($this->file->getRealPath()), 'public');

            // Save to database with transaction
            $assignment_upload = \DB::transaction(function () use ($filePath) {
                return Assignment_upload::create([
                    'student_id' => auth()->id(),
                    'file_path' => $filePath,
                    'assignment_id' => $this->assignment_id,
                    'submitted_at' => now(),
                    'status' => 'submitted',
                ]);
            });

            $this->uploadedFile = $assignment_upload;
            $this->previewUrl = $this->getPreviewUrl();

            \Log::info('Dispatching StudentAssignmentNotification for assignment ID: ' . $assignment_upload->id);
            // Dispatch event
            event(new StudentAssignmentNotification($assignment_upload, auth()->user()));
            $gemService = new GemService();
            if ($this->assignment->isOverdue()) {
                session()->flash('warning', 'Assignment submitted after due date.');
            } else {
                $gemService->earnedGem(10, 'Earned By Submitting Assignment.');
                if ($this->checkConsecutiveSubmissions(auth()->id())) {
                    $gemService->earnedGem(100, 'Bonus for completing 7 consecutive on-time assignments!');
                    session()->flash('success', 'Assignment submitted successfully. You earned 10 gems plus 100 bonus gems for completing 7 assignments on time!');
                } else {
                    session()->flash('success', 'Assignment submitted successfully. You earned 10 gems!');
                }
            }
        } catch (\Exception $e) {
            \Log::error('Assignment upload failed: ' . $e->getMessage());
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