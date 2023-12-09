<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->where('status', true)->get(); // all sub categories
        $brands = Brand::where('status', true)->get();
        return view('dashboard.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->except(['_token', 'image']);
        $path = $request->file('image')->store('products');
        $data['image'] = $path;
        Product::create($data);
        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $categories = Category::whereNotNull('parent_id')->where('status', true)->get(); // all sub categories
        $brands = Brand::where('status', true)->get();
        return view('dashboard.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $data = $request->except(['_token', 'image']);
        $old_image = $product->image;
        // if new image uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products');
            $data['image'] = $path;
        }
        $product->update($data);
        // delete old image if new image uploaded
        if ($request->hasFile('image') && $old_image) {
            Storage::delete($old_image);
        }
        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $product->delete();
        Storage::delete($product->image);
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
