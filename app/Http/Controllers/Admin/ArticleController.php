<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query()->with(['category', 'author']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $articles = $query->latest('published_at')->paginate(10)->appends($request->query());
        $counts = [
            'all' => Article::count(),
            'published' => Article::published()->count(),
            'draft' => Article::where('status', 'draft')->count(),
            'scheduled' => Article::where('status', 'scheduled')->count(),
        ];
        $categories = Category::orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'counts', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('admin.articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:articles,slug'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'status' => ['required', 'in:draft,published,scheduled'],
            'published_at' => ['nullable', 'date'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'thumbnail' => ['nullable', 'image', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'featured' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['body'] = Purifier::clean($data['body']);
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('article-thumbnails', 'public');
            $data['thumbnail_url'] = Storage::url($path);
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('status', 'Article created.');
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('admin.articles.edit', compact('article', 'categories', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:articles,slug,' . $article->id],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'status' => ['required', 'in:draft,published,scheduled'],
            'published_at' => ['nullable', 'date'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'thumbnail' => ['nullable', 'image', 'max:5120'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'featured' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['body'] = Purifier::clean($data['body']);
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('article-thumbnails', 'public');
            $data['thumbnail_url'] = Storage::url($path);
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('status', 'Article updated.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('status', 'Article deleted.');
    }
}
