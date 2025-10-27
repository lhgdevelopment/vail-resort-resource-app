<?php

namespace App\Http\Controllers;

use App\Models\Lto;
use App\Models\LtoMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LtoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ltos = Lto::orderBy('priority', 'asc')->orderBy('id', 'desc')->get();
        return view('backend.ltos.index', compact('ltos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ltoMonths = LtoMonth::where('status', true)->get();
        return view('backend.ltos.create', compact('ltoMonths'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'lto_month_id' => 'nullable|exists:lto_months,id',
            'priority' => 'nullable|integer',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif|max:500420',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('ltos', 'public');
            }
            $data['images'] = $images;
        }

        Lto::create($data);

        return redirect()->route('ltos.index')->with('success', 'LTO created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lto = Lto::find($id);
        return view('backend.ltos.show', compact('lto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lto = Lto::find($id);
        $ltoMonths = LtoMonth::where('status', true)->get();
        return view('backend.ltos.create', compact('lto', 'ltoMonths'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'lto_month_id' => 'nullable|exists:lto_months,id',
            'priority' => 'nullable|integer',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif|max:10420'
        ]);

        $lto = Lto::find($id);
        $data = $request->all();

        // Handle image updates
        if ($request->hasFile('images')) {
            // Delete old images
            if ($lto->images) {
                foreach ($lto->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            // Save new images
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('ltos', 'public');
            }
            $data['images'] = $images;
        }

        $lto->update($data);

        return redirect()->route('ltos.index')->with('success', 'LTO updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lto = Lto::find($id);
        if ($lto->images) {
            foreach ($lto->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $lto->delete();
        return redirect()->route('ltos.index')->with('success', 'LTO deleted successfully.');
    }

    /**
     * Update the order/priority of LTOs via AJAX (for drag-and-drop).
     */
    public function reorder(Request $request)
    {
        \Log::info('Reorder API called', ['data' => $request->all()]);
        
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:ltos,id',
            'orders.*.priority' => 'required|integer',
        ]);

        foreach ($request->orders as $order) {
            Lto::where('id', $order['id'])->update(['priority' => $order['priority']]);
        }

        \Log::info('Reorder completed successfully');

        return response()->json([
            'success' => true,
            'message' => 'LTO order updated successfully.',
        ]);
    }
}
