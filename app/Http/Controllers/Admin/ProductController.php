<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variants']);

        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);

        return view('admin.products.product-page', compact('products'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Simpan produk & varian
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'weight' => 'nullable|integer|min:1',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'variants' => 'required|array',
            'gender' => 'required|in:pria,wanita,anak,unisex'
        ]);

        $hasEnabledVariant = false;
        foreach ($request->variants as $variant) {
            if (isset($variant['enabled'])) {
                $hasEnabledVariant = true;
                break;
            }
        }

        if (!$hasEnabledVariant) {
            return back()->withErrors(['variants' => 'Harap centang minimal satu ukuran (S, M, L...)'])->withInput();
        }


        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products', 'public');
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'slug' => Str::slug($request->product_name) . '-' . Str::random(5),
            'description' => $request->description,
            'weight' => $request->weight,
            'thumbnail' => $thumbnailPath,
            'gender' => $request->gender,
            'is_active' => true,
        ]);

        foreach ($request->variants as $size => $data) {
            if (isset($data['enabled'])) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'price' => (int) $data['price'],
                    'stock' => (int) $data['stock'],
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('variants');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk & varian
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'weight' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required|in:pria,wanita,anak,unisex',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
                $path = $request->file('thumbnail')->store('products', 'public');
                $product->thumbnail = $path;
            }

            $product->update([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'slug' => Str::slug($request->product_name) . '-' . Str::random(5),
                'description' => $request->description,
                'weight' => $request->weight,
                'gender' => $request->gender,
                'is_active' => $request->has('is_active'),
            ]);

            $product->variants()->delete();

            foreach ($request->variants as $size => $data) {
                if (isset($data['enabled'])) {
                    $product->variants()->create([
                        'product_id' => $product->id,
                        'size' => $size,
                        'price' => $data['price'],
                        'stock' => $data['stock'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk dihapus.');
    }
}
