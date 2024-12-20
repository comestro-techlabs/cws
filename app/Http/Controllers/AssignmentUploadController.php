<?php

namespace App\Http\Controllers;

use App\Models\Assignment_upload;
use App\Models\Assignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AssignmentUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['assignment']=Assignments::all();
        return view('studentDashboard.course.assignments.studentAssignment',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

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
