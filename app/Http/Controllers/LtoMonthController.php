<?php

namespace App\Http\Controllers;

use App\Models\LtoMonth;
use Illuminate\Http\Request;

class LtoMonthController extends Controller
{
    public function index()
    {
        $ltoMonths = LtoMonth::orderBy('id', 'desc')->get();
        return view('backend.lto_months.index', compact('ltoMonths'));
    }

    public function create()
    {
        return view('backend.lto_months.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'month_name' => 'required|string',
            'year' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        LtoMonth::create($request->all());

        return redirect()->route('lto_months.index')->with('success', 'LTO Month created successfully');
    }

    public function edit(LtoMonth $ltoMonth)
    {
        return view('backend.lto_months.create', compact('ltoMonth'));
    }

    public function update(Request $request, LtoMonth $ltoMonth)
    {
        $request->validate([
            'month_name' => 'required|string',
            'year' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $ltoMonth->update($request->all());

        return redirect()->route('lto_months.index')->with('success', 'LTO Month updated successfully');
    }

    public function destroy($id)
    {
        return $id;
        $ltoMonth->delete();

        return redirect()->route('lto_months.index')->with('success', 'LTO Month deleted successfully');
    }
}
