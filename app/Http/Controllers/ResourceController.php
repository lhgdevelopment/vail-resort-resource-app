<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index()
    {
        $resources = Resource::with('category')->orderBy('created_at', 'desc')->get();
        return view('backend.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.resources.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'author'            => 'nullable|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'tags'              => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive',
            'feature_image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:500240', // 10MB max
        ]);

        // Handle feature image upload
        $featureImagePath = null;
        if ($request->hasFile('feature_image')) {
            $featureImagePath = $request->file('feature_image')->store('resources/feature_images', 'public');
        }

        // Create the resource
        Resource::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'author'          => $request->author,
            'category_id'     => $request->category_id,
            'tags'            => $request->tags,
            'status'          => $request->status,
            'feature_image'  => $featureImagePath,
        ]);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('backend.resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        $categories = Category::all();
        return view('backend.resources.edit', compact('resource', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        // Validate the request data
        $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'author'            => 'nullable|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'tags'              => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive',
            'feature_image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:500240', // 10MB max
        ]);

        // Handle feature image upload
        $featureImagePath = $resource->feature_image;
        if ($request->hasFile('feature_image')) {
            // Delete the old feature image if exists
            if ($featureImagePath && Storage::disk('public')->exists($featureImagePath)) {
                Storage::disk('public')->delete($featureImagePath);
            }

            // Upload the new feature image
            $featureImagePath = $request->file('feature_image')->store('resources/feature_images', 'public');
        }

        // Update the resource
        $resource->update([
            'title'           => $request->title,
            'description'     => $request->description,
            'author'          => $request->author,
            'category_id'     => $request->category_id,
            'tags'            => $request->tags,
            'status'          => $request->status,
            'feature_image' => $featureImagePath,
        ]);

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        // Delete the feature image if it exists
        if ($resource->feature_image && Storage::disk('public')->exists($resource->feature_image)) {
            Storage::disk('public')->delete($resource->feature_image);
        }

        // Delete the resource
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }
}
