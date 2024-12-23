<?php

namespace App\Http\Controllers;

use App\Models\FeelSpecial;
use App\Models\LtoBannerSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LtoBannerSliderController extends Controller
{
    /**
     * Display a listing of the lto-banner-slider.
     */
    public function index()
    {
        // Fetch all sliders ordered by creation date
        $sliders = LtoBannerSlider::orderBy('created_at', 'desc')->get();
        return view('backend.lto-slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create()
    {
        return view('backend.lto-slider.create');
    }

    /**
     * Store a newly created slider in storage.
     */
    public function store(Request $request)
    {

        $feelSpail = FeelSpecial::firstOrFail();
        // Validate the incoming data
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:500240',
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('lto_banner_sliders', 'public');
        }

        // Create the slider
        LtoBannerSlider::create([
            'feel_special_id' => $feelSpail->id,
            'file_name' => $request->file_name,
            'file_path' => $filePath,
        ]);

        return redirect()->route('lto-banner-slider.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified slider.
     */
    public function show(LtoBannerSlider $slider)
    {
        return view('backend.lto-slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified slider.
     */
    public function edit(LtoBannerSlider $slider)
    {
        return view('backend.lto-slider.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     */
    public function update(Request $request, LtoBannerSlider $slider)
    {
        // Validate the incoming data
        $request->validate([
            'feel_special_id' => 'required|exists:feel_special,id',
            'file_name' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:500240',
        ]);

        // Handle file upload
        if ($request->hasFile('file_path')) {
            // Delete old file if exists
            if ($slider->file_path && Storage::disk('public')->exists($slider->file_path)) {
                Storage::disk('public')->delete($slider->file_path);
            }

            // Store new file
            $slider->file_path = $request->file('file_path')->store('lto_banner_sliders', 'public');
        }

        // Update other fields
        $slider->feel_special_id = $request->feel_special_id;
        $slider->file_name = $request->file_name;
        $slider->save();

        return redirect()->route('lto-banner-slider.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified slider from storage.
     */
    public function destroy(LtoBannerSlider $slider)
    {
        // Delete file if exists
        if ($slider->file_path && Storage::disk('public')->exists($slider->file_path)) {
            Storage::disk('public')->delete($slider->file_path);
        }

        // Delete the slider
        $slider->delete();

        return redirect()->route('lto-banner-slider.index')->with('success', 'Slider deleted successfully.');
    }
}
