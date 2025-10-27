<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryFileController extends Controller
{
    /**
     * Display files for a category.
     */
    public function index(Category $category)
    {
        $files = CategoryFile::where('category_id', $category->id)->orderBy('priority', 'asc')->get();
        return view('backend.categories.files.index', compact('category', 'files'));
    }

    /**
     * Show the form for creating a new file.
     */
    public function create(Category $category)
    {
        return view('backend.categories.files.create', compact('category'));
    }

    /**
     * Store a newly uploaded file.
     */
    public function store(Request $request, Category $category)
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
            $filePath = $request->file('file_path')->store('categories/files', 'public');
            $fileType = $request->file('file_path')->getClientOriginalExtension();
        }

        CategoryFile::create([
            'category_id' => $category->id,
            'resource_type' => $request->resource_type,
            'file_path' => $filePath,
            'file_name' => $request->file_name,
            'file_type' => $fileType,
            'embed_code' => $request->embed_code,
            'external_link' => $request->external_link,
            'priority' => 0,
        ]);

        return redirect()->route('categories.files.index', $category->id)->with('success', 'File uploaded successfully.');
    }

    /**
     * Remove the specified file.
     */
    public function destroy(CategoryFile $file)
    {
        if ($file->resource_type === 'file' && $file->file_path) {
            Storage::disk('public')->delete($file->file_path);
        }
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }

    /**
     * Update the order/priority of category files via AJAX.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:category_files,id',
            'orders.*.priority' => 'required|integer',
        ]);

        foreach ($request->orders as $order) {
            CategoryFile::where('id', $order['id'])->update(['priority' => $order['priority']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category files order updated successfully.',
        ]);
    }

    /**
     * Download the specified file.
     */
    public function download(CategoryFile $file)
    {
        $filePath = storage_path('app/public/' . $file->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        
        return response()->download($filePath, $file->file_name . '.' . $file->file_type);
    }
}
