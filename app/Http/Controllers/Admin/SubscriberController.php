<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscriber::query();

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest('subscribed_at')->paginate(15)->appends($request->query());
        $stats = [
            'total' => Subscriber::count(),
            'active' => Subscriber::where('active', true)->count(),
            'new_this_week' => Subscriber::whereBetween('subscribed_at', [now()->subWeek(), now()])->count(),
        ];

        return view('admin.subscribers.index', compact('subscribers', 'stats'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('status', 'Subscriber removed.');
    }
}
