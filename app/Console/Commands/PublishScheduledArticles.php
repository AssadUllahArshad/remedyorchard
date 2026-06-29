<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class PublishScheduledArticles extends Command
{
    protected $signature   = 'articles:publish-scheduled';
    protected $description = 'Publish any scheduled articles whose published_at date has arrived';

    public function handle(): void
    {
        $count = Article::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->update(['status' => 'published']);

        $this->info("Published {$count} scheduled article(s).");
    }
}
