<?php

namespace App\Livewire\Admin\Assignment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\User;
use Exception;
use Google\Client;
use Google\Service\Drive;

#[Layout('components.layouts.admin')]
#[Title('Assignment Upload')]
class AssignmentUpload extends Component
{
    public $fileData = [];
    public $courses = [];
    public $course;
    public $students = [];
    public $assignments = [];
    public $student;
    public $assignment;
    public $slug;
    public $id;
    public $grade;
    public $viewMode = 'index'; // Default view mode

    protected $queryString = ['slug', 'id'];

    private function getClient()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $refreshToken = config('services.google.refresh_token');
        $accessToken = config('services.google.access_token');
        if (!empty($accessToken)) {
            $client->setAccessToken($accessToken);
        }

        if ($client->isAccessTokenExpired()) {
            if (!empty($refreshToken)) {
                $newAccessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $client->setAccessToken($newAccessToken);
                config(['services.google.access_token' => $newAccessToken['access_token']]);
            } else {
                throw new Exception('Refresh token is missing or invalid.');
            }
        }

        return $client;
    }

    private function getDriveService()
    {
        $client = $this->getClient();
        return new Drive($client);
    }

    public function mount($slug = null, $id = null)
    {
        $this->slug = $slug;
        $this->id = $id;

        if ($this->id && User::find($this->id)) {
            $this->viewMode = 'singleStudent';
            $this->loadSingleStudentAssignment();
        } elseif ($this->id && Assignments::find($this->id)) {
            $this->viewMode = 'reviewWork';
            $this->loadAssignmentReviewWork();
        } elseif ($this->slug) {
            $this->viewMode = 'assignmentReview';
            $this->loadAssignmentReview();
        } elseif (request()->routeIs('assignment.course')) {
            $this->viewMode = 'assignmentCourse';
            $this->loadAssignmentCourse();
        } else {
            $this->viewMode = 'index';
            $this->loadIndex();
        }
    }

    public function loadIndex()
    {
        $driveService = $this->getDriveService();
        $driveFiles = $driveService->files->listFiles([
            'q' => "'" . config('services.google.folder_id') . "' in parents",
        ]);

        $driveFileIds = collect($driveFiles->getFiles())->pluck('id');
        $dbFiles = Assignment_upload::all();

        $this->fileData = [];
        foreach ($dbFiles as $file) {
            if ($driveFileIds->contains($file->file_path)) {
                $this->fileData[] = [
                    'id' => $file->file_path,
                    'name' => $file->assignment->title,
                    'course' => $file->assignment->course->title,
                    'user' => $file->user->name,
                    'status' => $file->status,
                    'submitted_at' => $file->submitted_at,
                ];
            }
        }
    }

    public function syncFiles()
    {
        $driveService = $this->getDriveService();
        $driveFiles = $driveService->files->listFiles([
            'q' => "'" . config('services.google.folder_id') . "' in parents",
        ]);

        $driveFileIds = collect($driveFiles->getFiles())->pluck('id');
        $dbFileIds = Assignment_upload::pluck('file_path');

        $missingInDb = $driveFileIds->diff($dbFileIds);
        foreach ($missingInDb as $fileId) {
            // Log or notify admin
        }

        $missingInDrive = $dbFileIds->diff($driveFileIds);
        foreach ($missingInDrive as $fileId) {
            Assignment_upload::where('file_path', $fileId)->delete();
        }

        $this->loadIndex();
        session()->flash('success', 'Files synced successfully!');
    }

    public function downloadFile($fileId)
    {
        try {
            $driveService = $this->getDriveService();
            $fileMetadata = $driveService->files->get($fileId);

            if (!$fileMetadata) {
                throw new Exception('File not found on Google Drive.');
            }

            $fileContent = $driveService->files->get($fileId, ['alt' => 'media']);
            $fileName = $fileMetadata->getName();

            return response()->streamDownload(function () use ($fileContent) {
                echo $fileContent->getBody()->getContents();
            }, $fileName, [
                'Content-Type' => $fileMetadata->getMimeType(),
            ]);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function loadAssignmentCourse()
    {
        $this->courses = Course::with('assignments', 'users')
            ->has('assignments')
            ->get();

        foreach ($this->courses as $course) {
            $course->unique_user_count = Assignment_upload::whereIn('assignment_id', $course->assignments->pluck('id'))
                ->distinct('student_id')
                ->count('student_id');
            $course->total_users = $course->users->count();
        }
    }

    public function loadAssignmentReview()
    {
        $this->course = Course::with(['assignments', 'assignments.uploads.user'])
            ->where('slug', $this->slug)
            ->firstOrFail();

        $this->students = Assignment_upload::whereIn('assignment_id', $this->course->assignments->pluck('id'))
            ->with('user')
            ->get()
            ->groupBy('student_id')
            ->map(function ($uploads) {
                return [
                    'user' => $uploads->first()->user,
                    'upload_count' => $uploads->count(),
                    'grade' => $uploads->first()->grade,
                ];
            });

        $this->assignments = $this->course->assignments;
    }

    public function loadSingleStudentAssignment()
    {
        $this->student = User::findOrFail($this->id);
        $this->assignments = $this->student->uploads()->with('assignment')->get();
    }

    public function loadAssignmentReviewWork()
    {
        $this->assignment = Assignments::with('uploads')->findOrFail($this->id);
        $this->students = Assignment_upload::where('assignment_id', $this->id)
            ->with('user')
            ->get()
            ->groupBy('student_id')
            ->map(function ($uploads) {
                return [
                    'name' => $uploads->first()->user->name,
                    'uploads' => $uploads,
                ];
            });
    }

    public function insertGrade($assignmentId, $studentId)
    {
        $this->validate([
            'grade' => 'required|string|max:2',
        ]);

        $upload = Assignment_upload::where('assignment_id', $assignmentId)
            ->where('student_id', $studentId)
            ->first();

        if ($upload) {
            $upload->grade = $this->grade;
            $upload->status = 'graded';
            $upload->save();
        } else {
            Assignment_upload::create([
                'assignment_id' => $assignmentId,
                'student_id' => $studentId,
                'grade' => $this->grade,
                'status' => 'graded',
                'submitted_at' => now(),
            ]);
        }

        $this->loadAssignmentReviewWork();
        session()->flash('success', 'Grade inserted successfully!');
    }
    public function render()
    {
        return view('livewire.admin.assignment.assignment-upload');
    }
}
