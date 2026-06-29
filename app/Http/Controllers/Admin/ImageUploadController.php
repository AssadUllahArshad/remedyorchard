<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        $path = $request->file('image')->store('body-images', 'public');

        return response()->json(['url' => Storage::url($path)]);
    }
}
