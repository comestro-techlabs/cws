<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
use App\Models\Workshop;
use Carbon\Carbon;

class WorkshopController extends Controller
{
   public function index()
 {
//      $workshops = Workshop::where('active', 1)->get(); 
//      return view('public.workshop', compact('workshops')); 

     $currentDateTime =now();
     $startTime = Carbon::createFromTime(8,0);
     $endTime = Carbon::createFromTime(13,0);
     $workshops = Workshop::where('date','>=',$currentDateTime->toDateString())
     ->where(function($query) use ($currentDateTime){
      $query->where('time', '>=',$currentDateTime->format('H:i'))
      ->orWhere('date','>',$currentDateTime->toDateString());
     })
    //  ->whereBetween('time',['08:00:00','10:00:00'])
    ->whereTime('time','>=',$startTime->format('H:i'))
    ->whereTime('time','<=',$endTime->format('H:i'))
      ->get();

      return view('public.workshop',compact('workshops'));
  
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
    $currentTime = now()->format('H:i');
    $cutoffTime = '10:00';
    if ($request->time > $cutoffTime){
      return redirect()->back()->with('error','you can\'t enter,time is up');
    }
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
      $workshop->update($request->all());
      return redirect()->route('workshops.admin.index')->with('success', 'Workshop updated successfully.');
  }

  public function destroy($id)
  {
      $workshop = Workshop::findOrFail($id);
      $workshop->delete();
      return redirect()->route('workshops.admin.index')->with('success', 'Workshop deleted successfully.');
  }
  public function processPayment(Request $request,$workshopId){
   $workshop = Workshop::findOrFail($workshopId);
   $workshop->update([
    'payment_status' =>'completed',
    // 'transction_id' => $transaction,
   ]);
  
  return redirect()->route('workshops.index')->with('sucess','Payment Successful!');
  }


  
}

  
