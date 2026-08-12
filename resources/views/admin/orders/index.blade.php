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
    .anim-slide-up { animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .anim-fade-in { animation: fadeIn 0.6s ease-out forwards; opacity: 0; }
    @keyframes slideUpFade { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Styling khusus untuk Nav-Pills Status Pesanan */
    .nav-pills-custom .nav-link {
        color: #6c757d;
        border-radius: 50rem;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .nav-pills-custom .nav-link.active {
        background-color: #10b981;
        color: #fff;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
    }
</style>

<div class="container-fluid px-4 py-2">
    <div class="row g-4">
        
        <!-- Sidebar Premium -->
        <nav class="col-md-3 col-lg-2 sidebar-modern shadow-lg anim-slide-up d-none d-md-flex flex-column" style="min-height: 92vh;">
            <div class="pt-4 px-2 flex-grow-1">
                <div class="text-center mb-4 pb-2 border-bottom border-light border-opacity-25">
                    <div class="bg-white text-success rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-2" style="width: 48px; height: 48px;">
                        <i class="fas fa-leaf fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-white mb-0">Admin Panel</h6>
                    <small class="text-white-50">{{ config('app.name', 'Tokoku') }} Workspace</small>
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
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
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
                        <!-- Class 'active' Pindah ke Sini -->
                        <a class="nav-link active" href="{{ route('admin.orders.index') }}">
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
            
            <!-- Profil Bawah & Tombol Logout -->
            <div class="mt-auto p-3 mb-2">
                <div class="bg-white bg-opacity-10 rounded-4 p-3 d-flex align-items-center justify-content-between shadow-sm border border-light border-opacity-10">
                    <div class="d-flex align-items-center overflow-hidden">
                        <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold flex-shrink-0" style="width: 36px; height: 36px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="text-truncate">
                            <span class="d-block text-white fw-bold small text-truncate">{{ Auth::user()->name }}</span>
                            <span class="d-block text-white-50" style="font-size: 0.65rem;">Administrator</span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline m-0 p-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-link text-white text-opacity-75 p-0 m-0 hover-danger transition-all" title="Keluar">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Konten Utama Pesanan -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 anim-fade-in">
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Manajemen Pesanan</h3>
                    <p class="text-muted small mb-0">Pantau dan kelola seluruh pesanan pelanggan yang masuk.</p>
                </div>
                <!-- Form Pencarian Pesanan -->
                <form class="d-flex gap-2 m-0">
                    <div class="input-group input-group-sm shadow-sm">
                        <span class="input-group-text bg-white border-end-0 text-muted rounded-start-pill px-3">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" placeholder="Cari ID Pesanan..." style="min-width: 250px;">
                    </div>
                </form>
            </div>

            <!-- Tab Filter Status (UI Preview) -->
            <ul class="nav nav-pills nav-pills-custom mb-4 gap-2">
                <li class="nav-item"><a class="nav-link active" href="#">Semua <span class="badge bg-white text-success ms-1">0</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Menunggu <span class="badge bg-secondary ms-1">0</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Diproses <span class="badge bg-secondary ms-1">0</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Dikirim <span class="badge bg-secondary ms-1">0</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Selesai</a></li>
            </ul>

            <!-- Tabel Pesanan -->
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase" style="letter-spacing: 0.5px;">
                                <tr>
                                    <th class="py-3 ps-4 rounded-start-3">ID Pesanan</th>
                                    <th class="py-3">Pelanggan</th>
                                    <th class="py-3">Tanggal Order</th>
                                    <th class="py-3">Total Harga</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 text-end pe-4 rounded-end-3">Aksi</th>
                                </tr>
                            </thead>
<tbody>
                                @forelse($orders as $order)
                                <tr class="hover-shadow">
                                    <td class="ps-4 fw-bold text-success py-3">{{ $order->order_number }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold text-uppercase" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                {{ substr($order->user->name ?? 'U', 0, 2) }}
                                            </div>
                                            <div>
                                                <span class="fw-medium text-dark d-block">{{ $order->user->name ?? 'Pelanggan Hapus' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $order->created_at->format('d M Y') }}<br>
                                        {{ $order->created_at->format('H:i') }} WIB
                                    </td>
                                    <td class="fw-bold text-dark">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($order->status == 'menunggu')
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold border border-warning border-opacity-25"><i class="fas fa-clock me-1"></i> Menunggu</span>
                                        @elseif($order->status == 'diproses')
                                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill fw-bold border border-info border-opacity-25"><i class="fas fa-box me-1"></i> Diproses</span>
                                        @elseif($order->status == 'dikirim')
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold border border-primary border-opacity-25"><i class="fas fa-truck me-1"></i> Dikirim</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold border border-success border-opacity-25"><i class="fas fa-check me-1"></i> Selesai</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" title="Proses Pesanan">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                                <i class="fas fa-receipt fs-1 opacity-50"></i>
                                            </div>
                                            <h5 class="fw-bold">Belum Ada Pesanan</h5>
                                            <p>Saat ini belum ada data pesanan yang masuk ke toko Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 