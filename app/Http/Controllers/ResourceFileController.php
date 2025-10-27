<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceFileController extends Controller
{
    public function index(Resource $resource)
    {
        $files = ResourceFile::where('resource_id', $resource->id)->get();
        return view('backend.resources.files.index', compact('resource', 'files'));
    }

    public function create(Resource $resource)
    {
        return view('backend.resources.files.create', compact('resource'));
    }

    public function store(Request $request, Resource $resource)
    {
        
        $request->validate([
            'file_name' => 'required|string|max:255',
            'resource_type' => 'required|in:file,embed_code,external_link',
            'file_path' => 'required_if:resource_type,file|file|mimes:pdf,jpg,jpeg,png,ppt,pptx|max:5000240',
            'embed_code' => 'required_if:resource_type,embed_code',
            'external_link' => 'required_if:resource_type,external_link|url',
        ]); 

        $filePath = null;
        $fileType = null;

        if ($request->resource_type === 'file' && $request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('resources/files', 'public');
            $fileType = $request->file('file_path')->getClientOriginalExtension();
        }

        ResourceFile::create([
            'resource_id' => $resource->id,
            'resource_type' => $request->resource_type,
            'file_path' => $filePath,
            'file_name' => $request->file_name,
            'file_type' => $fileType,
            'embed_code' => $request->embed_code,
            'external_link' => $request->external_link,
        ]);

        return redirect()->route('resources.files.index', $resource->id)->with('success', 'Resource file added successfully.');
    }

    public function edit($id)
    {
        $resourceFile = ResourceFile::findOrFail($id);
        return view('backend.resources.files.edit', compact('resourceFile'));
    }

    public function update(Request $request, $id)
    {
        $resourceFile = ResourceFile::findOrfail($id);
        
        $request->validate([
            'file_name' => 'required|string|max:255',
            'resource_type' => 'required|in:file,embed_code,external_link',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png,ppt,pptx|max:5000240',
            'embed_code' => 'required_if:resource_type,embed_code|string|nullable',
            'external_link' => 'required_if:resource_type,external_link|url|nullable',
        ]);

        // Store old values in case resource type changed
        $oldResourceType = $resourceFile->resource_type;
        $oldFilePath = $resourceFile->file_path;

        // Update basic fields
        $resourceFile->file_name = $request->file_name;
        $resourceFile->resource_type = $request->resource_type;
        
        // Handle resource type changes - clear old data when switching types
        if ($oldResourceType !== $request->resource_type) {
            // Clear file if switching away from file type
            if ($oldResourceType === 'file' && $oldFilePath) {
                Storage::disk('public')->delete($oldFilePath);
                $resourceFile->file_path = null;
                $resourceFile->file_type = null;
            }
            
            // Clear old fields
            $resourceFile->embed_code = null;
            $resourceFile->external_link = null;
        }
        
        // Handle file upload
        if ($request->resource_type === 'file') {
            if ($request->hasFile('file_path')) {
                // Delete old file if exists
                if ($oldFilePath) {
                    Storage::disk('public')->delete($oldFilePath);
                }
                // Upload new file
                $resourceFile->file_path = $request->file('file_path')->store('resources/files', 'public');
                $resourceFile->file_type = $request->file('file_path')->getClientOriginalExtension();
            }
            // Clear other fields
            $resourceFile->embed_code = null;
            $resourceFile->external_link = null;
        }
        
        // Handle embed code
        if ($request->resource_type === 'embed_code') {
            $resourceFile->embed_code = $request->embed_code;
            $resourceFile->file_path = null;
            $resourceFile->file_type = null;
            $resourceFile->external_link = null;
        }
        
        // Handle external link
        if ($request->resource_type === 'external_link') {
            $resourceFile->external_link = $request->external_link;
            $resourceFile->file_path = null;
            $resourceFile->file_type = null;
            $resourceFile->embed_code = null;
        }
        
        $resourceFile->save();

        return redirect()->route('resources.files.index', $resourceFile->resource->id)->with('success', 'Resource file updated successfully.');
    }

    public function destroy(ResourceFile $file)
    {
        if ($file->resource_type === 'file' && $file->file_path) {
            Storage::disk('public')->delete($file->file_path);
        }
        $file->delete();

        return redirect()->back()->with('success', 'Resource file deleted successfully.');
    }
}
