<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Course;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->course_id) {
            $data['assignments'] = Assignments::where('course_id', $request->course_id)->get();
        } else {
            $data['assignments'] = Assignments::all();
        }
        $data['courses'] = Course::all();

        return view('admin.assignments.manageAssignments', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['courses'] = Course::all();
        return view('admin.assignments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Assignments::create($validated);

        // Redirect with a success message
        return redirect()->route('assignment.create')->with('success', 'Assignment created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Assignments $assignment)
    {
        //
        return view('admin.assignments.singleAssignment', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignments $assignments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignments $assignments)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assignment = Assignments::findOrFail($id);

        $assignment->delete();

        return redirect()->route('assignment.index')->with('msg', 'Deleted successfully');
    }
}
