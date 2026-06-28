<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        $articles = Article::with(['category', 'author'])
            ->published()
            ->latest('published_at')
            ->paginate(9);

        return view('remedies.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        $related = Article::with(['category', 'author'])
            ->published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(2)
            ->get();

        if ($related->isEmpty()) {
            $related = Article::with(['category', 'author'])
                ->published()
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(2)
                ->get();
        }

        return view('articles.show', compact('article', 'related'));
    }
}
