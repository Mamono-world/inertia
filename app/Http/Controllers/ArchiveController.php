<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    public function show()
    {
        return Inertia::render('archives', [
            'archive' => Archive::all() // Fetch all users and pass them to the Vue component
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'file_name' => 'required|string|max:255',
            'file_type' => 'required|string|max:255',
            'display' => 'boolean',
            'preorder' => 'boolean',
        ]);

        $path = $request->file('file')->store('uploads', 'public');
        $url = Storage::url($path);

        Archive::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $url,
            'file_name' => $request->file_name,
            'file_type' => $request->file_type,
            'display' => $request->display,
            'preorder' => $request->preorder,
            'sizes' => null,
        ]);

        return response()->json(['message' => 'Upload successful']);
    }

}
