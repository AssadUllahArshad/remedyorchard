<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->string('specialty')->nullable()->after('role');
            $table->string('qualifications')->nullable()->after('specialty');
            $table->unsignedSmallInteger('experience_years')->nullable()->after('qualifications');
            $table->text('education')->nullable()->after('bio');
            $table->boolean('is_active')->default(true)->after('education');
        });

        foreach (DB::table('authors')->whereNull('slug')->get(['id', 'name']) as $author) {
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
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn(['slug', 'specialty', 'qualifications', 'experience_years', 'education', 'is_active']);
        });
    }
};
