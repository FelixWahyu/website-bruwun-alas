<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KatalogProdukController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'variants'])
            ->where('is_active', true)
            ->latest()
            ->paginate(8);

        return view('katalog-produk', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'variants'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('produk-show', compact('product'));
    }
}
