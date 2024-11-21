<?php

namespace App\Http\Controllers;

use App\Models\Lto;
use App\Models\LtoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LtoFileController extends Controller
{
    public function index(Lto $lto)
    {
        $files = LtoFile::where('lto_id', $lto->id)->get();
        return view('backend.ltos.files.index', compact('lto', 'files'));
    }

    public function create(Lto $lto)
    {
        return view('backend.ltos.files.create', compact('lto'));
    }

    public function store(Request $request, Lto $lto)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,pptx,ppt,png,jpg,jpeg|max:20480',
        ]);

        $filePath = $request->file('file')->store('ltos/files', 'public');

        LtoFile::create([
            'lto_id' => $lto->id,
            'file_name' => $request->file_name,
            'file_path' => $filePath,
            'file_type' => $request->file('file')->getClientOriginalExtension(),
        ]);

        return redirect()->route('ltos.files.index', $lto->id)->with('success', 'File uploaded successfully.');
    }

    public function destroy(LtoFile $file)
    {
        Storage::disk('public')->delete($file->file_path);
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
