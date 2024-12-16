<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the sliders.
     */
    public function index()
    {
        // Fetch all sliders ordered by priority
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create()
    {
        return view('backend.sliders.create');
    }

    /**
     * Store a newly created slider in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'btn_link' => 'nullable|url|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500240',
            'priority' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
        }

        // Create the slider
        Slider::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'btn_link' => $request->btn_link,
            'image' => $imagePath ?? null,
            'priority' => $request->priority ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified slider.
     */
    public function show(Slider $slider)
    {
        return view('backend.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified slider.
     */
    public function edit(Slider $slider)
    {
        return view('backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'btn_link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500240',
            'priority' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('sliders', 'public');
            $slider->image = $imagePath;
        }

        // Update other fields
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->btn_link = $request->btn_link;
        $slider->priority = $request->priority ?? 0;
        $slider->status = $request->status;
        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified slider from storage.
     */
    public function destroy(Slider $slider)
    {
        // Delete image if exists
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        // Delete the slider
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
