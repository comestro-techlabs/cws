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
    // $currentDateTime = now();
    // $startTime = Carbon::createFromTime(8, 0);
    // $endTime = Carbon::createFromTime(13, 0);


    // $workshops = Workshop::with('payment')
    //     ->where('date', '>=', $currentDateTime->toDateString())
    //     ->where(function ($query) use ($currentDateTime) {
    //         $query->where('time', '>=', $currentDateTime->format('H:i'))
    //               ->orWhere('date', '>', $currentDateTime->toDateString());
    //     })
    //     ->whereTime('time', '>=', $startTime->format('H:i'))
    //     ->whereTime('time', '<=', $endTime->format('H:i'))
    //     ->get();
    $workshops = Workshop::get();
    $user_id = Auth::id();
    $userPayments = Payment::where("student_id", $user_id)
    ->where("status", "captured")
    ->pluck('workshop_id')
    ->toArray();

    return view('public.workshop', compact('workshops', 'userPayments'));
}




public function buyWorkshop($id)
{
    if (!Auth::check()) {
        return redirect()->route('auth.login')->with('error', 'You must be logged in to enroll in a workshop.');
    }

    $workshop = Workshop::findOrFail($id);
    $user_id = Auth::id();
    $currentMonth = Carbon::now()->month;
    $year = Carbon::now()->year;
    // Check if the user already has a successful payment for this workshop
    $payment_exist = Payment::where("student_id", $user_id)
        ->where("workshop_id", $id)
        ->where("status", "captured")
        ->exists();

    if ($workshop->fees == 0) {
        if (!$payment_exist) {
            // Insert a free payment record
            Payment::create([
                'student_id'   => $user_id,
                'workshop_id'  => $id,
                'amount'       => 0,
                'status'       => 'captured',
                'month' => $currentMonth,
                'year' => $year,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            return redirect()->route('public.workshop')->with('success', 'You have been enrolled in the workshop for free.');
        }

        return redirect()->route('public.workshop')->with('info', 'You are already enrolled.');
    }

    return view("public.workshop", compact('workshop', 'payment_exist'));
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



    return redirect()->route('workshops.admin.index')->with('success', 'Workshop created successfully!');
  }
  public function show()
  {
      $workshops = Workshop::all();
      return view('admin.workshops.index', compact('workshops'));
  }

//   public function edit($id){
//     $workshops = Workshop::findOrfail($id);
//     // return $workshops;
//      return view('workshops.edit', compact('workshops'));
//   }

  public function edit($id)
    {
    $workshop = Workshop::findOrFail($id);
    return view('admin.workshops.edit', compact('workshop'));
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


