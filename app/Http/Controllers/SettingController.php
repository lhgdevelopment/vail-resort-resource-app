<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $setting = Setting::getSetting();
        return view('backend.settings.index', compact('setting'));
    }

    /**
     * Show the form for editing the settings.
     */
    public function edit()
    {
        $setting = Setting::getSetting();
        return view('backend.settings.edit', compact('setting'));
    }

    /**
     * Update the settings in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'contact' => 'nullable|string|max:255',
        ]);

        $setting = Setting::findOrFail($id);

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                // Delete old logo
                Storage::disk('public')->delete($setting->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $setting->logo = $logoPath;
        }

        // Handle Icon Upload
        if ($request->hasFile('icon')) {
            if ($setting->icon) {
                // Delete old icon
                Storage::disk('public')->delete($setting->icon);
            }

            // Store new icon
            $iconPath = $request->file('icon')->store('icons', 'public');
            $setting->icon = $iconPath;
        }

        // Update other fields
        $setting->site_name = $request->input('site_name');
        $setting->contact = $request->input('contact');

        $setting->save();

        // Clear the cache to ensure updated settings are loaded
        Cache::forget('general_settings');

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }



    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get current settings
        $setting = Setting::getSetting();

        // Delete old logo if exists
        if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
            Storage::disk('public')->delete($setting->logo);
        }

        // Store new logo
        $path = $request->file('logo')->store('settings/logos', 'public');

        return response()->json(['success' => true, 'path' => $path]);
    }

    public function uploadIcon(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get current settings
        $setting = Setting::getSetting();

        // Delete old icon if exists
        if ($setting->icon && Storage::disk('public')->exists($setting->icon)) {
            Storage::disk('public')->delete($setting->icon);
        }

        // Store new icon
        $path = $request->file('icon')->store('settings/icons', 'public');

        return response()->json(['success' => true, 'path' => $path]);
    }

}
