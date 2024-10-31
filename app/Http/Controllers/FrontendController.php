<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FooterBanner;
use App\Models\Lto;
use App\Models\Resource;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect('register');
        }

        // Fetch active sliders ordered by priority.
        $sliders = Slider::where('status', 'active')
                        ->orderBy('priority', 'asc')
                        ->get();
                        
        // Fetch featured categories that are active, ordered by priority.
        $categories = Category::where('is_featured', true)
        ->where('status', 'active')
        ->orderBy('priority', 'asc')
        ->get();

        // Fetch footer banner
        $banner = FooterBanner::first();

        return view('frontend.welcome', compact('sliders', 'categories', 'banner'));
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

        if (Auth::user()->hasAnyRole($category->roles)) {
            return view('frontend.category_details', compact('category'));
        }else {
            return redirect('/');
        }
    }

    public function resourceDetails($id)
    {
        $resource = Resource::findOrFail($id);
        $category = Category::where('id', $resource->category_id)->firstOrFail();

        if (Auth::user()->hasAnyRole($category->roles)) {
            return view('frontend.resource_details', compact('resource', 'category'));
        }else {
            return redirect('/');
        }
    }

    public function ltoSelect(Request $request)
    {
        if (isset($request->year)) {
            $year = $request->year;
        } else {
            $currentDate = Carbon::now();
            $year = $currentDate->year;
        }
        
        return view('frontend.lto_select', compact('year'));
    }

    public function ltoList($month, $year)
    {
        // Convert the month name to a numeric month format
        $month = Carbon::parse($month)->month;

        if ($month && $year) {
            // Filter by selected month and year
            $ltos = LTO::whereYear('from_date', $year)
                        ->whereMonth('from_date', $month)
                        ->paginate(10);
        } else {
            // Default to the current month and year if no selection
            $currentDate = Carbon::now();
            $month = $currentDate->month;
            $year = $currentDate->year;

            $ltos = LTO::whereYear('from_date', $year)
                        ->whereMonth('from_date', $month)
                        ->paginate(10);
        }

        return view('frontend.lto', compact('ltos', 'month', 'year'));
    }

}
