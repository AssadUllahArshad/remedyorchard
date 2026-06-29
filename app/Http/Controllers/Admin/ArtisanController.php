<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    /**
     * Whitelist of commands that may be triggered via the web.
     * Key   = artisan command string
     * Value = display metadata
     */
    protected array $commands = [
        // ── Cache & Optimisation ──────────────────────────────────
        'optimize:clear' => [
            'label'       => 'Clear All Caches',
            'description' => 'Clears config, route, view, and event caches in one shot. Use this after any deployment.',
            'icon'        => 'bi-arrow-clockwise',
            'group'       => 'Cache & Optimisation',
        ],
        'optimize' => [
            'label'       => 'Cache Everything',
            'description' => 'Compiles and caches config, routes, and views for maximum performance on production.',
            'icon'        => 'bi-lightning-charge-fill',
            'group'       => 'Cache & Optimisation',
        ],
        'cache:clear' => [
            'label'       => 'Clear Application Cache',
            'description' => 'Clears the runtime application cache (cached queries, sessions stored in cache, etc.).',
            'icon'        => 'bi-trash',
            'group'       => 'Cache & Optimisation',
        ],
        'config:clear' => [
            'label'       => 'Clear Config Cache',
            'description' => 'Removes the compiled config file. Required after changing .env values.',
            'icon'        => 'bi-file-x',
            'group'       => 'Cache & Optimisation',
        ],
        'config:cache' => [
            'label'       => 'Cache Config',
            'description' => 'Compiles all configuration files into one fast-loading cached file.',
            'icon'        => 'bi-file-check',
            'group'       => 'Cache & Optimisation',
        ],
        'route:clear' => [
            'label'       => 'Clear Route Cache',
            'description' => 'Removes the compiled route file. Required after adding or renaming routes.',
            'icon'        => 'bi-signpost-split',
            'group'       => 'Cache & Optimisation',
        ],
        'route:cache' => [
            'label'       => 'Cache Routes',
            'description' => 'Compiles all routes into a single cached file for faster registration.',
            'icon'        => 'bi-signpost-fill',
            'group'       => 'Cache & Optimisation',
        ],
        'view:clear' => [
            'label'       => 'Clear View Cache',
            'description' => 'Deletes all compiled Blade templates. Views are recompiled on next request.',
            'icon'        => 'bi-eye-slash',
            'group'       => 'Cache & Optimisation',
        ],

        // ── Database ─────────────────────────────────────────────
        'migrate' => [
            'label'       => 'Run Migrations',
            'description' => 'Runs any pending database migrations. Safe to run repeatedly — skips already-run migrations.',
            'icon'        => 'bi-database-up',
            'group'       => 'Database',
        ],
        'migrate:status' => [
            'label'       => 'Migration Status',
            'description' => 'Lists every migration file and whether it has been run or not.',
            'icon'        => 'bi-database',
            'group'       => 'Database',
        ],
        'db:seed' => [
            'label'       => 'Run Seeders',
            'description' => 'Runs the DatabaseSeeder. Only use on a fresh database — seeders are not idempotent.',
            'icon'        => 'bi-database-add',
            'group'       => 'Database',
        ],

        // ── Content ───────────────────────────────────────────────
        'articles:publish-scheduled' => [
            'label'       => 'Publish Scheduled Articles',
            'description' => 'Manually triggers the scheduled article publisher — useful if the cron has not run yet.',
            'icon'        => 'bi-calendar-check',
            'group'       => 'Content',
        ],

        // ── System ────────────────────────────────────────────────
        'storage:link' => [
            'label'       => 'Create Storage Symlink',
            'description' => 'Creates the public/storage → storage/app/public symlink. Run once after a fresh deploy.',
            'icon'        => 'bi-link-45deg',
            'group'       => 'System',
        ],
        'queue:restart' => [
            'label'       => 'Restart Queue Workers',
            'description' => 'Signals all queue workers to restart gracefully after finishing their current job.',
            'icon'        => 'bi-arrow-repeat',
            'group'       => 'System',
        ],
    ];

    public function index()
    {
        $groups = [];
        foreach ($this->commands as $cmd => $meta) {
            $groups[$meta['group']][$cmd] = $meta;
        }

        return view('admin.artisan.index', compact('groups'));
    }

    public function run(Request $request)
    {
        $request->validate(['command' => 'required|string']);

        $command = $request->input('command');

        if (! array_key_exists($command, $this->commands)) {
            return back()->with('artisan_error', "Command [{$command}] is not in the allowed list.")->with('artisan_command', $command);
        }

        try {
            $exitCode = Artisan::call($command);
            $output   = trim(Artisan::output()) ?: '(no output — command completed successfully)';
        } catch (\Throwable $e) {
            return back()
                ->with('artisan_command', $command)
                ->with('artisan_error', $e->getMessage());
        }

        return back()
            ->with('artisan_command', $command)
            ->with('artisan_exit',    $exitCode)
            ->with('artisan_output',  $output);
    }
}
