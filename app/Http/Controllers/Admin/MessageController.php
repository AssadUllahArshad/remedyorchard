<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('status')) {
            $query->when($request->status === 'unread', fn ($q) => $q->where('read', false));
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $messages = $query->latest('received_at')->paginate(15)->appends($request->query());

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        $message->update(['read' => true]);

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return back()->with('status', 'Message deleted.');
    }
}
