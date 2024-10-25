<?php

namespace App\Http\Controllers;

use App\Models\Lto;
use Illuminate\Http\Request;

class LtoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ltos = Lto::get();
        return view('backend.ltos.index', compact('ltos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ltos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        Lto::create($request->all());

        return redirect()->route('ltos.index')->with('success', 'LTO created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lto $lto)
    {
        return view('backend.ltos.show', compact('lto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lto $lto)
    {
        return view('backend.ltos.create', compact('lto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lto $lto)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $lto->update($request->all());

        return redirect()->route('ltos.index')->with('success', 'LTO updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lto $lto)
    {
        $lto->delete();
        return redirect()->route('ltos.index')->with('success', 'LTO deleted successfully.');
    }
}
