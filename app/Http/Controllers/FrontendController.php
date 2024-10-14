<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Resource;
use App\Models\Slider;
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
        $featuredCategories = Category::where('is_featured', true)
        ->where('status', 'active')
        ->orderBy('priority', 'asc')
        ->get();

        return view('frontend.welcome', compact('sliders', 'featuredCategories'));
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
}
