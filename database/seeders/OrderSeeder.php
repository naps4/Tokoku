<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama yang ada di database (sebagai pembeli dummy)
        $user = User::first(); 
        
        // Kalau belum ada user sama sekali, kita hentikan agar tidak error
        if (!$user) {
            $this->command->info('Gagal: Buat minimal 1 akun user/admin dulu untuk mencoba pesanan.');
            return;
        }

        $statuses = ['menunggu', 'diproses', 'dikirim', 'selesai'];

        for ($i = 1; $i <= 15; $i++) {
            Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . str_pad($i, 4, '0', STR_PAD_LEFT), // Format: ORD-0001
                'total_price' => rand(50000, 500000), // Harga acak
                'status' => $statuses[array_rand($statuses)], // Status acak
                'created_at' => now()->subDays(rand(1, 10)) // Tanggal acak beberapa hari ke belakang
            ]);
        }
    }
}