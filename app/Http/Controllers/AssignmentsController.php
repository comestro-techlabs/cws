<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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
        $data['batches'] = Batch::all();

        return view('admin.assignments.manageAssignments', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['courses'] = Course::all();
        $data['batches'] = Batch::all();
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
            'batch_id' => 'required|exists:batches,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

       $assignment = Assignments::create($validated);
    //    dd($assignment);

        if($assignment->status == 1){
            $users = User::whereHas('courses', function ($query) use ($assignment) {
                $query->where('course_id', $assignment->course_id);
            })->get();
            foreach($users as $user){
                Mail::send('emails.assignment_notification', ['user'=> $user,'assignment'=> $assignment], function($message) use ($user){
                    $message->to($user->email, $user->name)->subject('New Assignment Available');

            });
        }
    }

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
    public function edit(Assignments $assignment)
{
    $courses = Course::all();
    $batches = Batch::all();

    return view('admin.assignments.editAssignment', compact('assignment', 'courses','batches'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignments $assignment)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $assignment->update($validated);

        // Redirect with a success message
        return redirect()->route('assignment.index')->with('success', 'Assignment created successfully!');
    }
    public function toggleStatus(Request $request, Assignments $assignment)
    {
        $assignment->status = !$assignment->status;
        $assignment->save();
        if($assignment->status == 1){
            $users = User::whereHas('courses', function ($query) use ($assignment) {
                $query->where('course_id', $assignment->course_id);
            })->get();
            foreach($users as $user){
                Mail::send('emails.assignment_notification', ['user'=> $user,'assignment'=> $assignment], function($message) use ($user){
                    $message->to($user->email, $user->name)->subject('New Assignment Available');

            });
        }
    }

        return redirect()->back()->with('success', 'assignment status updated successfully!');
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
