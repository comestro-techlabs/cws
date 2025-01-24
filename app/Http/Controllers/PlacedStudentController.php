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
        //
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
            'title' => 'required|string|max:255',
                   'name' => 'required',
                   'content' => 'required',
                   'position' => 'required',
                   'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                   
           ]);
           $imagePath = $request->file('image')->store('store', 'public');

           PlacedStudent::create([
               'name' => $request->title,
               'content' => $request->date,
               'position' => $request->time,
               'image' => $imagePath,
               
              
           ]);
           return redirect()->route('placedStudent.create')->with('success', 'placedstudent created successfully!');

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
    public function destroy(PlacedStudent $placedStudent)
    {
        //
    }
}
