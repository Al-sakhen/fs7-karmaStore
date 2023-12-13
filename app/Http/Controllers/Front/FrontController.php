<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }


    public function shop(Request $request)
    {
        $mainCategories = Category::with(['childrens'])->whereNull('parent_id')->where('status', true)->get();
        $brands = Brand::where('status', true)->get();


        $queryParams = $request->query();
        // Product Filteration
        $productsQuery = Product::query();
        // ------ category -------------
        if (isset($queryParams['category'])) {
            $productsQuery->where('category_id', $queryParams['category']);
        }
        // ------ brand -------------
        if (isset($queryParams['brand'])) {
            $productsQuery->where('brand_id', $queryParams['brand']);
        }

        $products = $productsQuery->where('status', true)
            ->paginate(isset($queryParams['limit']) ? $queryParams['limit'] : 12)
            ->withQueryString();
        return view('frontend.shop', compact('mainCategories', 'products', 'brands'));
    }
}
