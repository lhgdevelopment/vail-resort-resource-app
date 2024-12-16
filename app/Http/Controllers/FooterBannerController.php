<?php

namespace App\Http\Controllers;

use App\Models\FooterBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterBannerController extends Controller
{
    public function create()
    {
        $banner = FooterBanner::first();
        return view('backend.footer_banner.create', compact('banner'));
    }

    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:500240', // Limit to 10MB
        ]);

        $banner = FooterBanner::first() ?: new FooterBanner;

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::delete($banner->image);
            }
            $path = $request->file('image')->store('footer_banners', 'public');
            $banner->image = $path;
        }

        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->button_title = $request->button_title;
        $banner->button_link = $request->button_link;
        $banner->save();

        return redirect()->route('footer-banner.create')->with('success', 'Footer Banner updated successfully.');
    }

    public function edit()
    {
        $banner = FooterBanner::first();
        return view('footer_banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        return $this->storeOrUpdate($request);
    }
}
