<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class BuyController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::verified()
            ->latest()
            ->paginate(12);

        return view('buy.index', compact('categories', 'products'));
    }

    public function byCategory(Category $category)
    {
        $categories = Category::all();

        $products = Product::verified()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        return view('buy.index', compact('categories', 'products', 'category'));
    }

    public function show(Product $product)
    {
        abort_if($product->status !== 'verified', 404);

        return view('buy.show', compact('product'));
    }
}