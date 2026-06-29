<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        $file     = $request->file('image');
        $filename = $file->hashName();
        $file->move(public_path('uploads/body-images'), $filename);

        return response()->json(['url' => asset('uploads/body-images/' . $filename)]);
    }
}
