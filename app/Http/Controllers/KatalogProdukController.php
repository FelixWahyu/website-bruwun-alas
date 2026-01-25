<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class KatalogProdukController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk sidebar filter
        $categories = Category::withCount('products')->get();

        // 2. Mulai Query Produk
        $query = Product::with(['category', 'variants'])
            ->where('is_active', true);

        // 3. Filter Search (Nama Produk)
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // 4. Filter Kategori (Bisa pilih lebih dari satu, atau satu saja)
        if ($request->filled('category')) {
            // Jika input berupa array (checkbox) atau string (single link)
            $catIds = is_array($request->category) ? $request->category : [$request->category];
            $query->whereIn('category_id', $catIds);
        }

        // 5. Filter Gender
        if ($request->filled('gender')) {
            $genders = is_array($request->gender) ? $request->gender : [$request->gender];

            // Logic: Jika pilih Pria, tampilkan Pria DAN Unisex
            // Jika user ingin strict, hapus logic orWhere unisex di bawah
            $query->where(function ($q) use ($genders) {
                $q->whereIn('gender', $genders)
                    ->orWhere('gender', 'unisex');
            });
        }

        // 6. Sorting (Opsional: Termurah/Termahal)
        if ($request->sort == 'low_high') {
            // Sorting relasi agak kompleks di Eloquent standar, 
            // untuk simpel kita sort created_at dulu
            $query->oldest();
        } else {
            $query->latest();
        }

        // 7. Eksekusi Pagination
        // appends() berguna agar saat klik halaman 2, filter tidak hilang
        $products = $query->paginate(8)->appends($request->query());

        return view('katalog-produk', compact('products', 'categories'));
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
