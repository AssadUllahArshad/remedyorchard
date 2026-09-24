<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        foreach (DB::table('authors')->whereNull('slug')->orderBy('id')->get(['id', 'name']) as $author) {
            $base = Str::slug($author->name) ?: 'doctor-' . $author->id;
            $slug = $base;
            $suffix = 2;

            while (DB::table('authors')->where('slug', $slug)->where('id', '!=', $author->id)->exists()) {
                $slug = $base . '-' . $suffix++;
            }

            DB::table('authors')->where('id', $author->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        // Existing slugs are intentionally retained on rollback.
    }
};
