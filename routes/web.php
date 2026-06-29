<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\ArtisanController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Site Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/remedies', [ArticleController::class, 'index'])->name('remedies.index');
Route::get('/remedies/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit')->middleware('throttle:5,1');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe')->middleware('throttle:10,1');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-use', [PageController::class, 'terms'])->name('terms');
Route::get('/cookie-policy', [PageController::class, 'cookiePolicy'])->name('cookie-policy');
Route::get('/medical-disclaimer', [PageController::class, 'medicalDisclaimer'])->name('medical-disclaimer');
Route::get('/advertise', [PageController::class, 'advertise'])->name('advertise');
Route::post('/advertise', [ContactController::class, 'storeAdvertiseInquiry'])->name('advertise.submit')->middleware('throttle:5,1');

Route::get('/sitemap.xml', function () {
    $articles   = \App\Models\Article::published()
                    ->latest('published_at')
                    ->get(['slug', 'title', 'excerpt', 'thumbnail_url', 'published_at', 'updated_at']);
    $categories = \App\Models\Category::withCount('articles')
                    ->orderBy('name')
                    ->get(['id', 'slug', 'name', 'updated_at']);
    $first = $articles->first();
    $sitemapLastmod = $first ? $first->updated_at : now();
    return response()->view('sitemap', compact('articles', 'categories', 'sitemapLastmod'))
                     ->header('Content-Type', 'application/xml; charset=UTF-8')
                     ->header('Cache-Control', 'public, max-age=3600')
                     ->header('X-Robots-Tag', 'noindex');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /admin/\nDisallow: /login\nDisallow: /logout\n\nSitemap: " . url('/sitemap.xml') . "\n";
    return response($content, 200)->header('Content-Type', 'text/plain');
});

Route::get('/admin/login', fn () => redirect()->route('login'));

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/images/upload', [ImageUploadController::class, 'store'])->name('images.upload');

    Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');

    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
    Route::post('/cache/clear', [AdminSettingsController::class, 'clearCache'])->name('cache.clear');

    Route::get('/artisan', [ArtisanController::class, 'index'])->name('artisan.index');
    Route::post('/artisan/run', [ArtisanController::class, 'run'])->name('artisan.run');
});
