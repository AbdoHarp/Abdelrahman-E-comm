<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // show slider
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $trendingProduct = product::where('trending', 1)->latest()->take(15)->get();
        $newArrivalsProducts = product::latest()->take(16)->get();
        $featuredProducts =  product::where('featured', 1)->latest()->take(16)->get();
        return view('frontend/index', compact('sliders', 'trendingProduct', 'newArrivalsProducts', 'featuredProducts'));
    }
    // search par
    public function searchProducts(Request $request)
    {
        if ($request->search) {
            $searchProducts = product::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(15);
            return view('frontend/pages/search', compact('searchProducts'));
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }
    // newArrivals
    public function newArrivals()
    {
        $newArrivalsProducts = product::latest()->take(16)->get();
        return view('frontend/pages/new-arrivals', compact('newArrivalsProducts'));
    }
    // featuredProducts
    public function featuredProducts()
    {
        $featuredProducts = product::where('featured', 1)->latest()->get();
        return view('frontend/pages/featured-products', compact('featuredProducts'));
    }
    // show categories page
    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend/collection/category/index', compact('categories'));
    }

    // show All products page
    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            return view('frontend/collection/products/index', compact('category'));
        } else {
            return redirect()->back();
        }
    }
        // show singel product page

    public function productview(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $product  = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if ($product) {
                return view('frontend/collection/products/view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    // thanks page
    public function thankyou()
    {
        return view("frontend/thank-you");
    }
}
