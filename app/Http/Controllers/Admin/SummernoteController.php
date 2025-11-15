<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SummernoteController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        try {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('summernote', $filename, 'public');

            if (!$path) {
                return response()->json(['error' => 'Mentés sikertelen'], 500);
            }

            return response()->json([
                'url' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hiba: ' . $e->getMessage()], 500);
        }
    }
}
