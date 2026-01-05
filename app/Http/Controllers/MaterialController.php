<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string',
            'type' => 'required|in:video,pdf',
            'file' => 'required|file|mimes:mp4,pdf',
        ]);

        $path = $request->file('file')->store('materials', 'public');

        Material::create([
            'event_id' => $request->event_id,
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
            'key' => uniqid('material_')
        ]);

        return back()->with('success', 'Material has been added!');
    }
}
