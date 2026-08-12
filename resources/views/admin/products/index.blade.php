@extends('layouts.admin')

@section('content')
<style>
    body { background-color: #f8f9fa; }
    .sidebar-modern {
        background: linear-gradient(180deg, #064e3b 0%, #14532d 100%);
        min-height: 92vh;
        border-radius: 1.25rem;
    }
    .sidebar-modern .nav-link {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        padding: 0.8rem 1.2rem;
        border-radius: 0.75rem;
        margin-bottom: 0.3rem;
        transition: all 0.3s ease;
    }
    .sidebar-modern .nav-link:hover, .sidebar-modern .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .hover-shadow:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important; transform: translateY(-2px); transition: all 0.3s ease; }
    .anim-fade-in { animation: fadeIn 0.6s ease-out forwards; opacity: 0; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="container-fluid px-4 py-2">
    <div class="row g-4">
        
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar-modern shadow-lg anim-slide-up d-none d-md-flex flex-column" style="min-height: 92vh;">
            <div class="pt-4 px-2 flex-grow-1">
                <div class="text-center mb-4 pb-2 border-bottom border-light border-opacity-25">
                    <div class="bg-white text-success rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-2" style="width: 48px; height: 48px;">
                        <i class="fas fa-leaf fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-white mb-0">Admin Panel</h6>
                    <small class="text-white-50">{{ config('app.name', 'Tokoku') }} Sembako</small>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-th-large me-3 w-20px text-center"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mt-3 mb-1">
                        <small class="text-white-50 text-uppercase fw-bold px-3" style="font-size: 0.7rem; letter-spacing: 1px;">Katalog</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box-open me-3 w-20px text-center"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-tags me-3 w-20px text-center"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item mt-3 mb-1">
                        <small class="text-white-50 text-uppercase fw-bold px-3" style="font-size: 0.7rem; letter-spacing: 1px;">Transaksi</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-bag me-3 w-20px text-center"></i> Pesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-3 w-20px text-center"></i> Pelanggan
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Konten Utama -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 anim-fade-in">
            
            <!-- Header Halaman -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Manajemen Produk</h3>
                    <p class="text-muted small mb-0">Kelola katalog barang, harga, dan stok toko Anda.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success shadow-sm rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Produk Baru
                    </a>
                </div>
            </div>

            <!-- Pesan Sukses (Jika ada aksi tambah/edit/hapus) -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Area Tabel Data -->
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <form action="{{ route('admin.products.index') }}" method="GET" class="m-0">
                        <div class="input-group input-group-sm w-auto shadow-sm">
                            <span class="input-group-text bg-white border-end-0 text-muted rounded-start-pill px-3">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Cari nama produk..." style="min-width: 250px;">
                            <button type="submit" class="btn btn-success rounded-end-pill fw-bold px-3">Cari</button>
                        </div>
                    </form>
                </div>
                
                <div class="card-body px-4 pb-4 pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="text-muted small text-uppercase bg-light" style="letter-spacing: 0.5px;">
                                <tr>
                                    <th class="border-bottom-0 py-3 ps-3 rounded-start-3">Info Produk</th>
                                    <th class="border-bottom-0 py-3">Kategori</th>
                                    <th class="border-bottom-0 py-3">Harga</th>
                                    <th class="border-bottom-0 py-3">Stok</th>
                                    <th class="border-bottom-0 py-3 text-end pe-3 rounded-end-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @forelse($products as $product)
                                <tr class="hover-shadow">
                                    <td class="ps-3 py-3">
                                        <div class="d-flex align-items-center">
                                          <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : 'https://via.placeholder.com/150?text=Tanpa+Gambar' }}" class="rounded-3 shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $product->name }}">
                                            
                                            <div>
                                                <h6 class="fw-bold text-dark mb-0">{{ $product->name }}</h6>
                                                <small class="text-muted">Ditambahkan {{ $product->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill fw-bold border border-info border-opacity-25">
                                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                                        </span>
                                    </td>
                                    <td><span class="fw-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</span></td>
                                    <td>
                                        <!-- Logika warna stok: Merah jika habis, kuning jika menipis, hijau jika aman -->
                                        @if($product->stock <= 0)
                                            <span class="text-danger fw-bold"><i class="fas fa-times-circle me-1"></i> Habis</span>
                                        @elseif($product->stock < 10)
                                            <span class="text-warning fw-bold"><i class="fas fa-exclamation-triangle me-1"></i> Sisa {{ $product->stock }}</span>
                                        @else
                                            <span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> {{ $product->stock }} Unit</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group shadow-sm rounded-pill">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light text-primary border-0 px-3"><i class="fas fa-edit"></i></a>
                                            
                                            <!-- Form Hapus Produk -->
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger border-0 px-3">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-box-open fs-1 mb-3 opacity-50"></i>
                                            <h5 class="fw-bold">Belum ada produk</h5>
                                            <p>Silakan klik tombol "Tambah Produk Baru" untuk memulai.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination (Jika data lebih dari 10) -->
                    <div class="d-flex justify-content-end mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 