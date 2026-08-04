<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Mengambil kategori untuk dikaitkan dengan produk
        $sayuran = Category::where('slug', 'sayuran-segar')->first();
        $sembako = Category::where('slug', 'sembako')->first();
        $bumbu = Category::where('slug', 'bumbu-dapur')->first();

        $products = [
            // Produk Sayuran
            [
                'category_id' => $sayuran->id ?? 1,
                'name' => 'Kangkung Hidroponik',
                'description' => 'Kangkung segar ditanam secara hidroponik tanpa pestisida.',
                'price' => 5000,
                'stock' => 50,
            ],
            [
                'category_id' => $sayuran->id ?? 1,
                'name' => 'Bayam Merah Segar',
                'description' => 'Bayam merah kaya zat besi, dipanen langsung dari petani.',
                'price' => 4500,
                'stock' => 40,
            ],
            // Produk Sembako
            [
                'category_id' => $sembako->id ?? 2,
                'name' => 'Beras Premium 5kg',
                'description' => 'Beras putih pulen kualitas premium tanpa pemutih.',
                'price' => 75000,
                'stock' => 100,
            ],
            [
                'category_id' => $sembako->id ?? 2,
                'name' => 'Minyak Goreng Sawit 2L',
                'description' => 'Minyak goreng kemasan pouch.',
                'price' => 32000,
                'stock' => 80,
            ],
            // Produk Bumbu
            [
                'category_id' => $bumbu->id ?? 3,
                'name' => 'Bawang Merah Brebes 250gr',
                'description' => 'Bawang merah pilihan dengan aroma khas dan kuat.',
                'price' => 12000,
                'stock' => 30,
            ]
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $product['category_id'],
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
            ]);
        }
    }
}
