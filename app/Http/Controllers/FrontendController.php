<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lto;
use App\Models\Resource;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Fetch active sliders ordered by priority.
        $sliders = Slider::where('status', 'active')
                        ->orderBy('priority', 'asc')
                        ->get();
                        
        // Fetch featured categories that are active, ordered by priority.
        $categories = Category::where('is_featured', true)
        ->where('status', 'active')
        ->orderBy('priority', 'asc')
        ->get();

        return view('frontend.welcome', compact('sliders', 'categories'));
    }

    public function categoryList(Request $request)
    {
        // Get search query if exists
        $search = $request->input('search');

        // Query categories, filtering by search if provided
        $categories = Category::where('status', 'active')
                    ->when($search, function ($query, $search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orderBy('priority', 'asc')
                    ->paginate(8); // 12 records per page

        return view('frontend.category_list', compact('categories', 'search'));
    }

    public function categoryDetails($id)
    {
        $category = Category::with('resources')->where('id', $id)->firstOrFail();

        return view('frontend.category_details', compact('category'));
    }

    public function resourceDetails($id)
    {
        $resource = Resource::findOrFail($id);
        $category = Category::where('id', $resource->category_id)->firstOrFail();

        return view('frontend.resource_details', compact('resource', 'category'));
    }

    public function ltoList(Request $request)
    {
        $query = Lto::query();

        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Default to the current month if no month is selected
        if ($request->has('month') && $request->month) {
            // Extract month and year from the request
            [$month, $year] = explode('-', $request->month);

            // Create start and end date for the selected month
            $startDate = Carbon::createFromFormat('m-y', "$month-$year")->startOfMonth();
            $endDate = Carbon::createFromFormat('m-y', "$month-$year")->endOfMonth();

            // Filter based on the selected month
            $query->whereBetween('from_date', [$startDate, $endDate]);
        } else {
            // If no month is selected, default to current month
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            // Filter based on the current month
            $query->whereBetween('from_date', [$startDate, $endDate]);
        }

        $ltos = $query->orderBy('from_date', 'asc')->paginate(10);

        return view('frontend.lto', compact('ltos', 'currentMonth', 'currentYear'));
    }
}
