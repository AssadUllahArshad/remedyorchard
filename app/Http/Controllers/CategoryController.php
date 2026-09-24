<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $categories = Category::orderBy('name')->get();

        $articles = Article::with(['category', 'categories', 'author'])
            ->published()
            ->whereHas('categories', fn ($q) => $q->where('categories.id', $category->id))
            ->latest('published_at')
            ->get();

        return view('categories.show', compact('category', 'categories', 'articles'));
    }
}
