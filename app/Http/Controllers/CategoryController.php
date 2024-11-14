<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::get(); // Fetch categories
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('backend.categories.create', compact('roles'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name'              => 'required|string|max:255',
            'banner'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_featured'       => 'sometimes',
            'priority'          => 'nullable|integer',
            'status'            => 'required|in:active,inactive',
            'short_description' => 'nullable|string',
            'long_description'  => 'nullable|string',
            'roles'             => 'nullable|array',
            'roles.*'           => 'exists:roles,name',
        ]);

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
        } else {
            $bannerPath = null;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $thumbnailPath = null;
        }

        $roles = $request->roles;
        array_push($roles, 'super-admin');

        // Create the category
        Category::create([
            'name'              => $request->name,
            'banner'            => $bannerPath,
            'thumbnail'         => $thumbnailPath,
            'is_featured'       => $request->has('is_featured') ? true : false,
            'priority'          => $request->priority,
            'status'            => $request->status,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'roles'             => $roles,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('backend.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('backend.categories.edit', compact('category', 'roles'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request data
        $request->validate([
            'name'              => 'required|string|max:255',
            'banner'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_featured'       => 'sometimes',
            'priority'          => 'nullable|integer',
            'status'            => 'required|in:active,inactive',
            'short_description' => 'nullable|string',
            'long_description'  => 'nullable|string',
            'roles'             => 'nullable|array',
            'roles.*'           => 'exists:roles,name',
        ]);

        // Handle banner upload
        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($category->banner && Storage::disk('public')->exists($category->banner)) {
                Storage::disk('public')->delete($category->banner);
                Log::info("Deleted old banner: {$category->banner}");
            } elseif ($category->banner) {
                Log::warning("Attempted to delete non-existent banner: {$category->banner}");
            }

            $bannerPath = $request->file('banner')->store('banners', 'public');
        } else {
            $bannerPath = $category->banner; // Keep existing banner
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($category->thumbnail && Storage::disk('public')->exists($category->thumbnail)) {
                Storage::disk('public')->delete($category->thumbnail);
                Log::info("Deleted old thumbnail: {$category->thumbnail}");
            } elseif ($category->thumbnail) {
                Log::warning("Attempted to delete non-existent thumbnail: {$category->thumbnail}");
            }

            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $thumbnailPath = $category->thumbnail; // Keep existing thumbnail
        }

        $roles = $request->roles;
        array_push($roles, 'super-admin');
        
        // Update the category
        $category->update([
            'name'              => $request->name,
            'banner'            => $bannerPath,
            'thumbnail'         => $thumbnailPath,
            'is_featured'       => $request->has('is_featured') ? true : false,
            'priority'          => $request->priority,
            'status'            => $request->status,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'roles'             => $roles,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Delete banner if exists
        if ($category->banner) {
            if (Storage::disk('public')->exists($category->banner)) {
                Storage::disk('public')->delete($category->banner);
                Log::info("Deleted banner: {$category->banner}");
            } else {
                Log::warning("Attempted to delete non-existent banner: {$category->banner}");
            }
        }

        // Delete thumbnail if exists
        if ($category->thumbnail) {
            if (Storage::disk('public')->exists($category->thumbnail)) {
                Storage::disk('public')->delete($category->thumbnail);
                Log::info("Deleted thumbnail: {$category->thumbnail}");
            } else {
                Log::warning("Attempted to delete non-existent thumbnail: {$category->thumbnail}");
            }
        }

        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
