<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['partials.footer', 'partials.header'], function ($view) {
            $view->with('footerCategories', Category::orderBy('name')->get()->map(fn ($c) => ['name' => $c->name, 'slug' => $c->slug])->toArray());
        });

        View::composer('admin.*', function ($view) {
            $user = Auth::user();
            $initials = 'AD';

            if ($user && $user->name) {
                $parts = array_filter(explode(' ', $user->name));
                $initials = strtoupper(implode('', array_map(fn ($part) => substr($part, 0, 1), $parts)));
            }

            $view->with([
                'articleCount' => Article::count(),
                'categoryCount' => Category::count(),
                'subscriberCount' => Subscriber::where('active', true)->count(),
                'unreadMessageCount' => ContactMessage::where('read', false)->count(),
                'authUserInitials' => $initials,
                'authUserName' => $user?->name,
                'authUserRole' => $user?->roles->pluck('name')->first() ?? 'Admin',
            ]);
        });
    }
}
