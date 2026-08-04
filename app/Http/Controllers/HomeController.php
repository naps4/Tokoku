<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori untuk ditampilkan di menu/sidebar
        $categories = Category::all();

        // Mengambil produk terbaru, dibatasi 12 produk per halaman (pagination)
        // with('category') digunakan untuk menghindari N+1 query problem (Eager Loading)
        $products = Product::with('category')->latest()->paginate(12);

        // Mengirim data ke tampilan 'home' (kita akan buat view ini nanti)
        return view('home', compact('categories', 'products'));
    }
}