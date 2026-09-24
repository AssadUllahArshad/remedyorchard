<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Author::active()->withCount('articles')->orderBy('name')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function show(string $doctor)
    {
        $doctor = Author::query()
            ->where(function ($query) use ($doctor) {
                $query->where('slug', $doctor);
            })
            ->firstOrFail();

        abort_unless($doctor->is_active, 404);
        $articles = $doctor->articles()->with(['category', 'categories', 'author'])->published()->latest('published_at')->get();
        return view('doctors.show', compact('doctor', 'articles'));
    }
}
