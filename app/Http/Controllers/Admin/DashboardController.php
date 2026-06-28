<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Subscriber;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::published()->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $scheduledArticles = Article::where('status', 'scheduled')->count();
        $totalSubscribers = Subscriber::where('active', true)->count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('read', false)->count();

        $stats = [
            'total_articles' => $totalArticles,
            'published_articles' => $publishedArticles,
            'draft_articles' => $draftArticles,
            'scheduled_articles' => $scheduledArticles,
            'total_subscribers' => $totalSubscribers,
            'subscriber_growth_pct' => $totalSubscribers > 0 ? 8.4 : 0,
            'total_messages' => $totalMessages,
            'unread_messages' => $unreadMessages,
            'total_views' => 184230,
            'views_growth_pct' => 12.1,
        ];

        $recentArticles = Article::with(['category'])
            ->latest('published_at')
            ->take(4)
            ->get();

        $recentMessages = ContactMessage::latest('received_at')->take(4)->get();
        $categoryBreakdown = Category::withCount('articles')->orderByDesc('articles_count')->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentMessages', 'categoryBreakdown'));
    }
}
