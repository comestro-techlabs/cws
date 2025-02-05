<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('admin.message.manage', compact('messages'));
    }
    public function create()
    {
        $batches = Batch::with('course')->get();
        $users = User::all();
        return view('admin.message.create', compact('batches', 'users'));
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

        $recipients = [];

        if ($request->recipient_type === 'all_users') {
            $recipients = User::pluck('id')->map(fn($id) => (int) $id)->toArray();
        } elseif ($request->recipient_type === 'batch' && $request->batch_id) {
            $batch = Batch::find($request->batch_id);
            if ($batch) {
                $recipients = $batch->users->pluck('id')->map(fn($id) => (int) $id)->toArray();
            }
        } elseif ($request->recipient_type === 'single_user' && $request->user_id) {
            $recipients = [(int) $request->user_id];
        } elseif ($request->recipient_type === 'some_users' && !empty($request->some_user_ids)) {
            $recipients = array_unique(array_map('intval', $request->some_user_ids));
        }

        Message::create([
            'title' => $request->title,
            'content' => $request->content,
            'recipient_type' => $request->recipient_type,
            'recipients' => $recipients,
        ]);

        return redirect()->route('messages.create')->with('success', 'Message created successfully.');
    }
    public function show(Message $message)
    {
        $recipients = $message->recipients ?? [];
        $recipientDetails = User::whereIn('id', $recipients)->get();

        return view('admin.message.view', compact('message', 'recipientDetails'));
    }
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.manage')->with('success', 'Message Deleted Successfully');
    }

    public function studentMessages()
    {
        $student = auth()->user();
        $messages = Message::whereJsonContains('recipients', $student->id)->get();

        return view('studentdashboard.notification', compact('messages'));
    }

    public function showMessage(Message $message)
    {
        $student = auth()->user();
        if (!in_array($student->id, $message->recipients)) {
            abort(403, 'Unauthorized');
        }

        return view('studentdashboard.viewMessage', compact('message'));
    }
}
