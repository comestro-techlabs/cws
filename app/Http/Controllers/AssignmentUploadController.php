<?php

namespace App\Http\Controllers;

use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Http;

class AssignmentUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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

        // Check if the token has expired and refresh if necessary
        if ($client->isAccessTokenExpired()) {
            if (!empty($refreshToken)) {
                // Refresh the token using the refresh token
                $newAccessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $client->setAccessToken($newAccessToken);

                // Optionally, save the new access token to a secure location
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
    public function index()
    {
        $driveService = $this->getDriveService();

        // Retrieve files from Google Drive folder
        $driveFiles = $driveService->files->listFiles([
            'q' => "'" . config('services.google.folder_id') . "' in parents",
        ]);

        $driveFileIds = collect($driveFiles->getFiles())->pluck('id');

        // Retrieve files from the database
        $dbFiles = Assignment_upload::all();

        $fileData = [];

        foreach ($dbFiles as $file) {
            if ($driveFileIds->contains($file->file_path)) {
                $fileData[] = [
                    'id' => $file->file_path,
                    'name' => $file->assignment->title, // Assuming assignment title
                    'course' => $file->assignment->course->title, // Assuming assignment title
                    'user' => $file->user->name,
                    'status' => $file->status,
                    'submitted_at' => $file->submitted_at,
                ];
            }
        }

        return view('admin.assignments.submitAssignment', ['fileData' => $fileData]);
    }
    public function syncFiles()
    {
        $driveService = $this->getDriveService();
        $driveFiles = $driveService->files->listFiles([
            'q' => "'" . config('services.google.folder_id') . "' in parents",
        ]);

        $driveFileIds = collect($driveFiles->getFiles())->pluck('id');
        $dbFileIds = Assignment_upload::pluck('file_path');

        // Missing in Database
        $missingInDb = $driveFileIds->diff($dbFileIds);
        foreach ($missingInDb as $fileId) {
            // Log or Notify Admin
        }

        // Missing in Drive
        $missingInDrive = $dbFileIds->diff($driveFileIds);
        foreach ($missingInDrive as $fileId) {
            Assignment_upload::where('file_path', $fileId)->delete(); // Clean up DB
        }
    }


    public function downloadFile($fileId)
    {
        try {
            $driveService = $this->getDriveService();

            // Check if the file exists
            $fileMetadata = $driveService->files->get($fileId);

            if (!$fileMetadata) {
                throw new Exception('File not found on Google Drive.');
            }

            // Get file content
            $fileContent = $driveService->files->get($fileId, [
                'alt' => 'media',
            ]);

            $fileName = $fileMetadata->getName();

            return response($fileContent->getBody()->getContents())
                ->header('Content-Type', $fileMetadata->getMimeType())
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404); // 404 for file not found
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Assignment_upload $assignment_upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment_upload $assignment_upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment_upload $assignment_upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment_upload $assignment_upload)
    {
        //
    }
    public function assignmentCourse() {
        $data['courses'] = Course::with('assignments', 'users') 
            ->has('assignments') 
            ->get();
    
        foreach ($data['courses'] as $course) {
            $course->unique_user_count = Assignment_upload::whereIn('assignment_id', $course->assignments->pluck('id'))
                ->distinct('student_id')
                ->count('student_id');
            
            $course->total_users = $course->users->count(); 
        }
    
        return view('admin.assignments.assignmentCourse', $data);
    }
    public function assignmentReview($slug) {
        $course = Course::with(['assignments', 'assignments.uploads.user'])
            ->where('slug', $slug)
            ->firstOrFail();

            $students = Assignment_upload::whereIn('assignment_id', $course->assignments->pluck('id'))
            ->with('user') 
            ->get()
            ->groupBy('student_id') 
            ->map(function ($uploads) {
                return [
                    'user' => $uploads->first()->user, 
                    'upload_count' => $uploads->count(), 
                ];
            });
    
        $data['course'] = $course;
        $data['students']=$students;
        $data['assignments'] = $course->assignments; 

        return view('admin.assignments.assignmentReview', $data);
    }
    public function manageSingleStudentAssignment($id){
        $data['student']=User::findOrFail($id);

        return view('admin.assignments.singleStudentAssignment',$data);
    }
    
    public function assignmentReviewWork($id)
    {
        $data['assignment'] = Assignments::with('uploads')->findOrFail($id);
    
        $data['students'] = Assignment_upload::where('assignment_id', $id)
            ->with('user') 
            ->get()
            ->groupBy('student_id') 
            ->map(function ($uploads) {
                return [
                    'name' => $uploads->first()->user->name,
                    'uploads' => $uploads, 
                    

                ];
            });
    
        // Pass the data to the view
        return view('admin.assignments.reviewWork', $data);
    }

    public function insertGrade(Request $request, $assignmentId, $studentId)
    {
        $validated = $request->validate([
            'grade' => 'required|string|max:2',  
        ]);
    
        $upload = Assignment_upload::where('assignment_id', $assignmentId)
            ->where('student_id', $studentId)
            ->first();
    
        if ($upload) {
            $upload->grade = $request->grade;
            $upload->status = 'graded';  
            $upload->save();
        } else {
            Assignment_upload::create([
                'assignment_id' => $assignmentId,
                'student_id' => $studentId,
                'grade' => $request->grade,
                'status' => 'graded',  
                'submitted_at' => now(),  
            ]);
        }
    
        return redirect()->route('assignment.reviewWork', $assignmentId)
            ->with('success', 'Grade inserted successfully!');
    }
    
    
    
}
