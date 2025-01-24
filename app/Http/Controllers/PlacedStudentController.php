<?php

namespace App\Http\Controllers;

use App\Models\PlacedStudent;
use Illuminate\Http\Request;

class PlacedStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['placedStudents']=PlacedStudent::all();
        return view('admin.placedStudent.manage',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.placedStudent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
    
        $imagePath = $request->file('image')->store('store', 'public');
    
        PlacedStudent::create([
            'name' => $request->name,
            'content' => $request->content,
            'position' => $request->position,
            'image' => $imagePath,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('placedStudent.create')->with('success', 'Placed student created successfully!');
    }
    public function toggleStatus(Request $request, PlacedStudent $placedStudent)
    {
        $placedStudent->status = !$placedStudent->status;
        $placedStudent->save();

        return redirect()->back()->with('success', 'placedStudent status updated successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(PlacedStudent $placedStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlacedStudent $placedStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlacedStudent $placedStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $placedStudent=PlacedStudent::findOrFail($id);
        $placedStudent->delete();
        return redirect()->back()->with('success','succesfully deleted');
    }
 
}
