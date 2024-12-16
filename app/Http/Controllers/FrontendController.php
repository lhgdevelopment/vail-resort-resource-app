<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeelSpecial;
use App\Models\FooterBanner;
use App\Models\Lto;
use App\Models\LtoMonth;
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
        $feelSpecial = FeelSpecial::first();

        return view('frontend.welcome', compact('sliders', 'categories', 'banner', 'feelSpecial'));
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
        // $resource = Resource::with(['resourceFiles' => function ($query) {
        //     $query->orderBy('file_name', 'asc'); // Sort by file_name in ascending order
        // }])->findOrFail($id);

        $searchTerm = request('search', ''); // Capture user input from the 'search' query string

        $resource = Resource::with(['resourceFiles' => function ($query) use ($searchTerm) {
            $query->when($searchTerm, function ($q) use ($searchTerm) {
                $q->where('file_name', 'like', "%{$searchTerm}%");
            })->orderBy('file_name', 'asc');
        }])->findOrFail($id);

        $category = Category::where('id', $resource->category_id)->firstOrFail();

        if (Auth::user()->hasAnyRole($category->roles)) {
            return view('frontend.resource_details', compact('resource', 'category'));
        }else {
            return redirect('/');
        }
    }

    public function ltoSelect(Request $request)
    {
        $monthsOrder = [
            'January' => 1, 'February' => 2, 'March' => 3,
            'April' => 4, 'May' => 5, 'June' => 6,
            'July' => 7, 'August' => 8, 'September' => 9,
            'October' => 10, 'November' => 11, 'December' => 12
        ];

        $ltoMonths = LtoMonth::where('status', 1)
            ->get()
            ->sort(function ($a, $b) use ($monthsOrder) {
                // Compare years first
                if ($a->year != $b->year) {
                    return $a->year - $b->year;
                }
                // Compare months by mapped numeric values
                return $monthsOrder[$a->month_name] - $monthsOrder[$b->month_name];
            })
            ->values(); // Re-index the collection after sorting

        return view('frontend.lto_select', compact('ltoMonths'));
    }

    public function ltoList($ltoMonthId)
    {
        // Retrieve the selected LTO month from the database
        $ltoMonth = LtoMonth::findOrFail($ltoMonthId);
        
        // Retrieve LTOs based on the selected month and year
        $ltos = LTO::where('lto_month_id', $ltoMonthId)
                ->paginate(10);

        return view('frontend.lto', compact('ltos', 'ltoMonth'));
    }

    public function ltoSignup()
    {
        return view('frontend.embade.lto_signup');
    }

    public function menuActivationSignup()
    {
        return view('frontend.embade.menu_activation_signup');
    }


}
