<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pesanan + data user pembelinya, dibatasi 10 per halaman
        $orders = Order::with('user')->latest()->paginate(10);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        // Cari pesanan berdasarkan ID, sekaligus ambil data user (pembeli) yang berelasi
        $order = Order::with('user')->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        // 1. Validasi input agar hanya menerima 5 status ini
        $request->validate([
            'status' => 'required|in:menunggu,diproses,dikirim,selesai,dibatalkan'
        ]);

        // 2. Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);
        
        // 3. Update statusnya
        $order->update([
            'status' => $request->status
        ]);

        // 4. Kembalikan ke halaman detail dengan pesan sukses
        return back()->with('success', 'Berhasil! Status pesanan telah diperbarui menjadi: ' . ucfirst($request->status));
    }
}