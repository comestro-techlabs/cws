<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    private function getRecipients(Request $request)
    {
        switch ($request->recipient_type) {
            case 'all_users':
                return User::pluck('id')->toArray();
            case 'batch':
                $batch = Batch::find($request->batch_id);
                return $batch ? $batch->users->pluck('id')->toArray() : [];
            case 'single_user':
                return [$request->user_id];
            case 'some_users':
                return array_unique($request->some_user_ids ?? []);
            default:
                return [];
            }
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'recipient_type' => 'required|in:all_users,batch,single_user,some_users',
            'batch_id' => 'required_if:recipient_type,batch|nullable|exists:batches,id',
            'some_user_ids' => 'required_if:recipient_type,some_users|array|nullable',
            'some_user_ids.*' => 'exists:users,id',
            'user_id' => 'required_if:recipient_type,single_user|nullable|exists:users,id',
        ]);
        $recipients = $this->getRecipients($request);
        if ($request->recipient_type === 'all_users') {
            $recipients = User::pluck('id')->toArray();
        } elseif ($request->recipient_type === 'batch' && $request->batch_id) {
            $batch = Batch::find($request->batch_id);
            if ($batch) {
                $recipients = $batch->users->pluck('id')->toArray();
            }
        } elseif ($request->recipient_type === 'single_user' && $request->user_id) {
            $recipients = [$request->user_id];
        } elseif ($request->recipient_type === 'some_users' && !empty($request->some_user_ids)) {
            $recipients = array_unique($request->some_user_ids); // Remove duplicates
        }
        Message::create([
            'title' => $request->title,
            'content' => $request->content,
            'recipient_type' => $request->recipient_type,
            'recipients' => $recipients, // No need for json_encode
        ]);

        return redirect()->route('messages.create')->with('success', 'Message created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $recipients = $message->recipients ?? [];
        $recipientDetails = User::whereIn('id', $recipients)->get();

        return view('admin.message.view', compact('message', 'recipientDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */



    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.manage')->with('success','Message Deleted Successfully');
    }

    public function userMessages()
    {
        $user = Auth::user();

        $messages = Message::where(function ($query) use ($user) {
            $query->where('recipient_type', 'all_users')
                  ->orWhere(function ($query) use ($user) {
                      $query->where('recipient_type', 'single_user')
                            ->whereJsonContains('recipients', $user->id);
                  })
                  ->orWhere(function ($query) use ($user) {
                      $query->where('recipient_type', 'some_users')
                            ->whereJsonContains('recipients', $user->id);
                  })
                  ->orWhere(function ($query) use ($user) {
                      $query->where('recipient_type', 'batch')
                            ->whereJsonContains('recipients', $user->id);
                  });
        })->get();

        return view('studentdashboard.notification', compact('messages'));
    }
}
