<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource (Dengan Fitur Search)
     */
    public function index(Request $request)
    {
        // 1. Tangkap kata kunci pencarian dari URL
        $search = $request->input('search');

        // 2. Buat query dasar: ambil produk + relasi kategori, urutkan dari yang terbaru
        $query = Product::with('category')->latest();

        // 3. Jika ada input pencarian, saring berdasarkan nama ATAU kategori
        if ($search) {
            // Kita bungkus di dalam function($q) agar query OR-nya menyatu dengan rapi (Grouping)
            $query->where(function($q) use ($search) {
                // Cari berdasarkan nama produk
                $q->where('name', 'LIKE', '%' . $search . '%')
                  // ATAU cari berdasarkan nama kategori di tabel relasi
                  ->orWhereHas('category', function($qCategory) use ($search) {
                      $qCategory->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        // 4. Paginate hasilnya (10 per halaman) 
        $products = $query->paginate(10)->appends(['search' => $search]);
        
        return view('admin.products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi file gambar
        ]);

        // Logika Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'storage/app/public/products'
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_url' => $imagePath, // <--- Simpan path gambar ke database
        ]);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Berhasil! Produk baru beserta gambar telah ditambahkan.');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $product = Product::findOrFail($id);
        
        // Simpan path gambar yang sudah ada sebagai default
        $imagePath = $product->image_url;

        // Jika user mengupload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama JIKA ADA
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            
            // Simpan gambar yang baru diupload
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_url' => $imagePath, // <--- Timpa dengan gambar baru (atau tetap gambar lama)
        ]);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Mantap! Data produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Cari data produk yang akan dihapus
        $product = Product::findOrFail($id);

        // 2. Hapus file gambar fisik dari folder storage (JIKA ADA)
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        // 3. Hapus data produk dari tabel database
        $product->delete();

        // 4. Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk dan gambarnya berhasil dihapus permanen.');
    }
}