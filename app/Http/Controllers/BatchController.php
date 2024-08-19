<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
{
    $courses = Course::all();
    $batches = Batch::with('course')->get();
    return view('admin.batches.index', compact('courses', 'batches'));
}



public function store(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'batch_name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'total_seats' => 'required|integer',
        'available_seats' => 'required|integer',
    ]);

    Batch::create($request->all());

    return redirect()->route('course.show',$request->course_id)->with('success', 'Batch added successfully.');
}

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the batch by ID
        $batch = Batch::findOrFail($id);

        // Delete the batch
        $batch->delete();

        // Redirect back with a success message
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully.');
    }
}
