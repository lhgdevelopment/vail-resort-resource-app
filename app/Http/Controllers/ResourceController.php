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
        $resources = Resource::with('category')->get();
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
            'type'              => 'required|in:file,link',
            'file_path'         => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif|max:5120',
            'embed_code'        => 'nullable|string',
            'tags'              => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive',
        ]);

        // Handle conditional fields based on type
        if ($request->type === 'file') {
            $request->validate([
                'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png,gif|max:5120',
            ]);

            if ($request->hasFile('file_path')) {
                $filePath = $request->file('file_path')->store('resources/files', 'public');
            } else {
                $filePath = null;
            }

            $embedCode = null;
        } else { // Link
            $request->validate([
                'embed_code' => 'required|string',
            ]);

            $embedCode = $request->embed_code;
            $filePath = null;
        }

        // Create the resource
        Resource::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'author'          => $request->author,
            'category_id'     => $request->category_id,
            'type'            => $request->type,
            'file_path'       => $filePath,
            'embed_code'      => $embedCode,
            'tags'            => $request->tags,
            'status'          => $request->status,
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
            'type'              => 'required|in:file,link',
            'file_path'         => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif|max:5120',
            'embed_code'        => 'nullable|string',
            'tags'              => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive',
        ]);

        // Handle conditional fields based on type
        if ($request->type === 'file') {
            $request->validate([
                'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png,gif|max:5120',
            ]);

            if ($request->hasFile('file_path')) {
                // Delete old file if exists
                if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                    Storage::disk('public')->delete($resource->file_path);
                }

                $filePath = $request->file('file_path')->store('resources/files', 'public');
            } else {
                $filePath = $resource->file_path;
            }

            $embedCode = null;
        } else { // Link
            $request->validate([
                'embed_code' => 'required|string',
            ]);

            $embedCode = $request->embed_code;

            // Delete old file if it exists since it's not needed for link type
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }

            $filePath = null;
        }

        // Update the resource
        $resource->update([
            'title'           => $request->title,
            'description'     => $request->description,
            'author'          => $request->author,
            'category_id'     => $request->category_id,
            'type'            => $request->type,
            'file_path'       => $filePath,
            'embed_code'      => $embedCode,
            'tags'            => $request->tags,
            'status'          => $request->status,
        ]);

        return redirect()->route('resources.index')->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        // Handle file deletion if resource type is file
        if ($resource->type === 'file' && $resource->file_path) {
            if (Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }
        }

        // Delete the resource
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully.');
    }
}
