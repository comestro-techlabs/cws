<?php

namespace App\Http\Controllers;

use App\Models\Assignment_upload;
use App\Models\Assignments;
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
}
