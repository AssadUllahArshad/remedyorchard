<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Admin_ArticleController;
use App\Http\Controllers\Admin\Admin_CategoryController;
use App\Http\Controllers\Admin\Admin_SubscriberController;
use App\Http\Controllers\Admin\Admin_MessageController;
use App\Http\Controllers\Admin\Admin_SettingsController;

/*
|--------------------------------------------------------------------------
| Public Site Routes
|--------------------------------------------------------------------------
| These map 1:1 to the Blade views in resources/views/.
| Controllers are referenced but not implemented — wire up your own
| Eloquent queries inside each controller method. The views already
| expect specific variable shapes; see the @php blocks at the top of
| each Blade file for the exact structure each view wants.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/remedies', [ArticleController::class, 'index'])->name('remedies.index');
Route::get('/remedies/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-use', [PageController::class, 'terms'])->name('terms');
Route::get('/cookie-policy', [PageController::class, 'cookiePolicy'])->name('cookie-policy');
Route::get('/medical-disclaimer', [PageController::class, 'medicalDisclaimer'])->name('medical-disclaimer');
Route::get('/advertise', [PageController::class, 'advertise'])->name('advertise');
Route::post('/advertise', [ContactController::class, 'storeAdvertiseInquiry'])->name('advertise.submit');


/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
| NOTE: No auth middleware applied yet — wire up Laravel's auth
| (Breeze/Fortify/custom guard) and protect this group with
| ->middleware(['auth', 'can:admin']) or similar before going live.
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [DashboardController::class, 'showLogin'])->name('login');
    // Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Articles (blog posts)
    Route::get('/articles', [Admin_ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [Admin_ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [Admin_ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [Admin_ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [Admin_ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [Admin_ArticleController::class, 'destroy'])->name('articles.destroy');

    // Categories
    Route::get('/categories', [Admin_CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [Admin_CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [Admin_CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [Admin_CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [Admin_CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [Admin_CategoryController::class, 'destroy'])->name('categories.destroy');

    // Newsletter subscribers
    Route::get('/subscribers', [Admin_SubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{subscriber}', [Admin_SubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Contact / advertise messages
    Route::get('/messages', [Admin_MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [Admin_MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [Admin_MessageController::class, 'destroy'])->name('messages.destroy');

    // Settings
    Route::get('/settings', [Admin_SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [Admin_SettingsController::class, 'update'])->name('settings.update');

});
