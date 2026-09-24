<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Author::withCount('articles')->orderBy('name')->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('avatar')) {
            $data['avatar_url'] = Storage::disk('public')->url($request->file('avatar')->store('doctor-avatars', 'public'));
        }
        unset($data['avatar']);
        Author::create($data);
        return redirect()->route('admin.doctors.index')->with('status', 'Doctor profile created.');
    }

    public function edit(Author $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Author $doctor)
    {
        $data = $this->validated($request, $doctor->id);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('avatar')) {
            $data['avatar_url'] = Storage::disk('public')->url($request->file('avatar')->store('doctor-avatars', 'public'));
        }
        unset($data['avatar']);
        $doctor->update($data);
        return redirect()->route('admin.doctors.index')->with('status', 'Doctor profile updated.');
    }

    public function destroy(Author $doctor)
    {
        if ($doctor->articles()->exists()) {
            return back()->with('error', "Cannot delete \"{$doctor->name}\" while articles are assigned to this doctor.");
        }
        $doctor->delete();
        return back()->with('status', 'Doctor profile deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:authors,slug' . ($ignoreId ? ',' . $ignoreId : '')],
            'role' => ['nullable', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:80'],
            'initials' => ['nullable', 'string', 'max:10'],
            'bio' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
