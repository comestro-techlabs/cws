<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        return view('admin.message.manage',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::with('course')->get();
        $users = User::all();
        return view('admin.message.create', compact('batches', 'users'));
     
    }

    /**
     * Store a newly created resource in storage.
     */
    
  

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'recipient_type' => 'required|in:all_users,batch,single_user,some_users',
            'batch_id' => 'nullable|exists:batches,id',
            'some_user_ids' => 'nullable|array', 
            'some_user_ids.*' => 'exists:users,id', 
            'user_id' => 'nullable|exists:users,id',
        ]);
    
        $recipients = [];
        if ($request->recipient_type === 'all_users') {
            $recipients = User::pluck('id')->toArray();
        } elseif ($request->recipient_type === 'batch') {
            $batch = Batch::find($request->batch_id);
            $recipients = $batch->users->pluck('id')->toArray();
        } elseif ($request->recipient_type === 'single_user') {
            $recipients = [$request->user_id];
        } elseif ($request->recipient_type === 'some_users') {
            $recipients = $request->some_user_ids;
        }
        Message::create([
            'title' => $request->title,
            'content' => $request->content,
            'recipient_type' => $request->recipient_type,
            'recipients' => json_encode($recipients),
        ]);
    
        return redirect()->route('messages.create')->with('success', 'Message created successfully.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
