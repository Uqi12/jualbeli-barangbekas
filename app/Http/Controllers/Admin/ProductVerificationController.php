<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVerificationController extends Controller
{
    public function index()
    {
        $products = Product::pending()->with(['seller', 'category'])->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function history()
    {
        $products = Product::whereIn('status', ['verified', 'fake'])
            ->with(['seller', 'category'])
            ->latest()
            ->paginate(20);

        return view('admin.products.history', compact('products'));
    }

    public function verify(Product $product)
    {
        $product->update(['status' => 'verified', 'admin_note' => null]);

        return back()->with('success', "Produk '{$product->name}' ditandai ASLI dan sekarang tampil di halaman Beli.");
    }

    public function markFake(Request $request, Product $product)
    {
        $validated = $request->validate([
            'admin_note' => 'nullable|string|max:500',
        ]);

        $product->update([
            'status' => 'fake',
            'admin_note' => $validated['admin_note'] ?? 'Ditandai sebagai barang palsu oleh admin.',
        ]);

        return back()->with('success', "Produk '{$product->name}' ditandai PALSU.");
    }
}