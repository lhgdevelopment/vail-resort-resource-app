<?php

namespace App\Http\Controllers;

use App\Models\LtoMonth;
use Illuminate\Http\Request;

class LtoMonthController extends Controller
{
    public function index()
    {
        $ltoMonths = LtoMonth::orderBy('priority', 'asc')->get();
        return view('backend.lto_months.index', compact('ltoMonths'));
    }

    public function create()
    {
        return view('backend.lto_months.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'priority' => 'nullable|integer',
        ]);

        LtoMonth::create($request->all());

        return redirect()->route('lto_months.index')->with('success', 'LTO Category created successfully');
    }

    public function edit($id)
    {
        $ltoMonth = LtoMonth::find($id);
        return view('backend.lto_months.create', compact('ltoMonth'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'priority' => 'nullable|integer',
        ]);

        $ltoMonth = LtoMonth::find($id);

        $ltoMonth->update($request->all());

        return redirect()->route('lto_months.index')->with('success', 'LTO Category updated successfully');
    }

    public function destroy($id)
    {
        $ltoMonth = LtoMonth::find($id);
        $ltoMonth->delete();

        return redirect()->route('lto_months.index')->with('success', 'LTO Month deleted successfully');
    }
}
