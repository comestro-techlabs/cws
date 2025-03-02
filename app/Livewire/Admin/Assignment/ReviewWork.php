<?php

namespace App\Livewire\Admin\Assignment;

use Livewire\Component;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Exception;
use Google\Client;
use Google\Service\Drive;

#[Layout('components.layouts.admin')]
#[Title('Manage Assignments')]
class ReviewWork extends Component
{
    public $assignmentId;
    public $grade = [];
    public $selectedFileId; // For preview
    public $previewContent; // Store file content temporarily
    public $previewMimeType; // Store MIME type for rendering

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

    public function mount($id)
    {
        $this->assignmentId = $id;
    }

    public function insertGrade($studentId)
    {
        $this->validate([
            "grade.$studentId" => 'required|string|max:2',
        ]);

        $upload = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->where('student_id', $studentId)
            ->first();

        if ($upload) {
            $upload->update([
                'grade' => $this->grade[$studentId],
                'status' => 'graded'
            ]);
        } else {
            Assignment_upload::create([
                'assignment_id' => $this->assignmentId,
                'student_id' => $studentId,
                'grade' => $this->grade[$studentId],
                'status' => 'graded',
                'submitted_at' => now(),
            ]);
        }

        session()->flash('success', 'Grade inserted successfully!');
    }

    public function previewFile($fileId)
    {
        try {
            $driveService = $this->getDriveService();
            $fileMetadata = $driveService->files->get($fileId);
            $fileContent = $driveService->files->get($fileId, ['alt' => 'media']);

            $this->selectedFileId = $fileId;
            $this->previewContent = base64_encode($fileContent->getBody()->getContents()); // Encode for inline display
            $this->previewMimeType = $fileMetadata->getMimeType();
        } catch (Exception $e) {
            session()->flash('error', 'Could not load file: ' . $e->getMessage());
            $this->selectedFileId = null;
        }
    }

    

    public function render()
    {
        $assignment = Assignments::with('uploads')->findOrFail($this->assignmentId);
        $students = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->with('user')
            ->get()
            ->groupBy('student_id')
            ->map(function ($uploads) {
                return [
                    'name' => $uploads->first()->user->name,
                    'uploads' => $uploads,
                    'submitted_at' => $uploads->first()->submitted_at,
                    'file_ids' => $uploads->pluck('file_path')->toArray(),
                    'grade' => $uploads->first()->grade,
                ];
            });
        return view('livewire.admin.assignment.review-work', [
                'assignment' => $assignment,
                'students' => $students,
        ]);
    }
    
}
