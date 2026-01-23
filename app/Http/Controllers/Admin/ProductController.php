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
        // Fitur Pencarian & Eager Loading Kategori + Varian
        $query = Product::with(['category', 'variants']);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
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
        // 1. Validasi Input
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'weight' => 'required|integer|min:1',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'variants' => 'required|array', // Wajib array
        ]);

        // Cek manual apakah ada ukuran yang dicentang
        // Karena input type="checkbox" tidak mengirim data jika tidak dicentang
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

        // --- MULAI PROSES TANPA TRY-CATCH (DEBUG MODE) ---

        // 2. Upload Gambar
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products', 'public');
        }

        // 3. Simpan Produk
        // Jika error "Mass Assignment", akan muncul di sini
        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'slug' => Str::slug($request->product_name) . '-' . Str::random(5),
            'description' => $request->description,
            'weight' => $request->weight,
            'thumbnail' => $thumbnailPath,
            'is_active' => true,
        ]);

        // 4. Simpan Varian
        foreach ($request->variants as $size => $data) {
            if (isset($data['enabled'])) {
                // Jika error "Field doesn't have default value", akan muncul di sini
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'price' => (int) $data['price'], // Casting ke integer biar aman
                    'stock' => (int) $data['stock'], // Casting ke integer biar aman
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
        // Load varian agar bisa ditampilkan di form
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
        ]);

        DB::beginTransaction();

        try {
            // 1. Handle Gambar Baru (Jika ada)
            if ($request->hasFile('thumbnail')) {
                // Hapus gambar lama
                if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                    Storage::disk('public')->delete($product->thumbnail);
                }
                // Upload baru
                $path = $request->file('thumbnail')->store('products', 'public');
                $product->thumbnail = $path;
            }

            // 2. Update Data Utama
            $product->update([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'slug' => Str::slug($request->product_name) . '-' . Str::random(5),
                'description' => $request->description,
                'weight' => $request->weight,
                'is_active' => $request->has('is_active'),
            ]);

            // 3. Sinkronisasi Varian
            // Hapus semua varian lama dulu (cara paling aman dan mudah untuk sync)
            // Atau bisa pakai updateOrCreate, tapi delete-insert lebih bersih untuk kasus checkbox
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
        // Hapus Gambar
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        // Varian akan terhapus otomatis karena 'onDelete cascade' di migration
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk dihapus.');
    }
}
