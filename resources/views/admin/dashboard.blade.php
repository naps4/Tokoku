@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar Menu Admin -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="list-group-item list-group-item-action">Kelola Kategori</a>
                <a href="#" class="list-group-item list-group-item-action">Kelola Produk</a>
                <a href="#" class="list-group-item list-group-item-action">Pesanan Masuk</a>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Dashboard Admin
                </div>
                <div class="card-body">
                    <h5 class="card-title">Selamat datang, {{ Auth::user()->name }}!</h5>
                    <p class="card-text">Ini adalah halaman pusat kendali toko sembako Anda. Dari sini Anda bisa mengelola stok barang, melihat pesanan, dan mengatur kategori.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card text-center bg-light mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Produk</h5>
                                    <h2 class="text-primary">0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-light mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Pesanan Baru</h5>
                                    <h2 class="text-success">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection