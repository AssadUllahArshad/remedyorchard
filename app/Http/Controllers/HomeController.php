<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::with(['category', 'author'])
            ->published()
            ->latest('published_at')
            ->take(4)
            ->get();

        $categories = Category::orderBy('name')->get();

        $stats = [
            'article_count' => Article::published()->count() ?: '340+',
            'newsletter_count' => Subscriber::where('active', true)->count() ?: '42K+',
            'clinician_count' => Author::count() ?: '18',
        ];

        return view('home', compact('latestArticles', 'categories', 'stats'));
    }
}
