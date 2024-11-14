<?php

namespace App\Http\Controllers;

use App\Models\FeelSpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeelSpecialController extends Controller
{
    public function index()
    {
        $feelSpecial = FeelSpecial::first();
        return view('backend.feel_special.index', compact('feelSpecial'));
    }

    public function update(Request $request, $id)
    {
        $feelSpecial = FeelSpecial::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'images' => 'nullable|array',
            'button_title' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|url',
        ]);

        // Check if new images are uploaded
        if ($request->hasFile('images')) {
            // Delete old images from storage
            if ($feelSpecial->images) {
                foreach ($feelSpecial->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            // Store new images
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('feel_special', 'public');
            }
            $data['images'] = $images;
        }

        $feelSpecial->update($data);

        return redirect()->route('feel_special.index')->with('success', 'Feel Special section updated successfully!');
    }

}
