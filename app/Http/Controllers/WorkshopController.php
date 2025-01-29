<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{

public function index()
{
    $currentDateTime = now();
    $startTime = Carbon::createFromTime(8, 0);
    $endTime = Carbon::createFromTime(13, 0);


    $workshops = Workshop::with('payment') 
        ->where('date', '>=', $currentDateTime->toDateString())
        ->where(function ($query) use ($currentDateTime) {
            $query->where('time', '>=', $currentDateTime->format('H:i'))
                  ->orWhere('date', '>', $currentDateTime->toDateString());
        })
        ->whereTime('time', '>=', $startTime->format('H:i'))
        ->whereTime('time', '<=', $endTime->format('H:i'))
        ->get();
    $workshops = Workshop::get();
   
    

    return view('public.workshop', compact('workshops'));
}


public function toggleStatus($id)
{
    $workshop = Workshop::findOrFail($id);
    $workshop->active = !$workshop->active;
    $workshop->save();
    return redirect()->back()->with('success', 'Workshop status updated successfully!');
}


  public function create(){
    return view('workshops.create');
  }

  public function store(Request $request){
    $request->validate([
     'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'required|boolean',
            'fees' => 'required|numeric|min:0',

            
    ]);
   
    $imagePath = $request->file('image')->store('workshops', 'public');

    Workshop::create([
        'title' => $request->title,
        'date' => $request->date,
        'time' => $request->time,
        'image' => $imagePath,
        'active' => $request->active,
        'fees'=>$request->fees,
       
    ]);
   

    
    return redirect()->route('workshops.admin.index')->with('success', 'Portfolio created successfully!');
  }
  public function show()
  {
      $workshops = Workshop::all();
      return view('workshops.index', compact('workshops'));
  }

  public function edit($id){
    $workshops = Workshop::findOrfail($id);
    // return $workshops;
     return view('workshops.edit', compact('workshops'));
  }

public function update(Request $request, $id)
{
    $workshop = Workshop::findOrFail($id);
  
//    dd($workshop);
     $request->validate([
        'title' => 'required|string|max:255',
        'date' => 'nullable|date',
        'time' => 'nullable',
        'fees' => 'required|min:0',
        'active' => 'required|boolean',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('workshops_images', 'public');
        $workshop->image = $imagePath;
    }
  
    $workshop->title = $request->title;
    $workshop->date = $request->date;
    $workshop->time = $request->time;
    $workshop->active = $request->active;
    $workshop->fees = $request->fees;  
    $workshop->save();

    
    return redirect()->route('workshops.admin.index')->with('success', 'Workshop updated successfully.');
}



  public function destroy($id)
  {
      $workshop = Workshop::findOrFail($id);
      $workshop->delete();
      return redirect()->route('workshops.admin.index')->with('success', 'Workshop deleted successfully.');
  }
  
}

  
