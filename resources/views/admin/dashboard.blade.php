@extends('layouts.admin')

@section('content')
<style>
    /* Styling Khusus Dashboard Professional */
    body { background-color: #f8f9fa; }
    
    .sidebar-modern {
        background: linear-gradient(180deg, #064e3b 0%, #14532d 100%);
        min-height: 85vh;
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
    
    .sidebar-modern .nav-link:hover, 
    .sidebar-modern .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 1rem;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    .icon-box {
        width: 54px; height: 54px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 1rem;
    }

    /* Animasi Staggered */
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .anim-slide-up { animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
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
                    <small class="text-white-50">{{ config('app.name', 'Tokoku') }} Sembako</small>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            <!-- Header Section -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Dashboard Overview</h3>
                    <p class="text-muted small mb-0">Pantau aktivitas toko dan performa penjualan Anda hari ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group input-group-sm shadow-sm">
                        <span class="input-group-text bg-white border-end-0 text-muted rounded-start-pill px-3"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill" placeholder="Cari pesanan...">
                    </div>
                    <button class="btn btn-sm btn-dark shadow-sm rounded-pill px-3 d-flex align-items-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Export
                    </button>
                </div>
            </div>

            <!-- Kartu Metrik Data -->
            <div class="row g-4 mb-5">
                <!-- Metrik 1 -->
                <div class="col-12 col-sm-6 col-xl-3 anim-slide-up delay-1">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted fw-semibold mb-1 small text-uppercase" style="letter-spacing: 0.5px;">Pendapatan</p>
                                    <h3 class="fw-bold text-dark mb-2">Rp 2.4M</h3>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold">
                                        <i class="fas fa-arrow-up me-1"></i> 12.5%
                                    </span>
                                    <span class="text-muted small ms-1">vs minggu lalu</span>
                                </div>
                                <div class="icon-box bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-wallet fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metrik 2 -->
                <div class="col-12 col-sm-6 col-xl-3 anim-slide-up delay-2">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted fw-semibold mb-1 small text-uppercase" style="letter-spacing: 0.5px;">Pesanan Baru</p>
                                    <h3 class="fw-bold text-dark mb-2">34</h3>
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1 small fw-bold">
                                        <i class="fas fa-arrow-down me-1"></i> 2.4%
                                    </span>
                                    <span class="text-muted small ms-1">vs minggu lalu</span>
                                </div>
                                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-shopping-cart fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metrik 3 -->
                <div class="col-12 col-sm-6 col-xl-3 anim-slide-up delay-3">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted fw-semibold mb-1 small text-uppercase" style="letter-spacing: 0.5px;">Total Produk</p>
                                    <h3 class="fw-bold text-dark mb-2">128</h3>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold">
                                        <i class="fas fa-plus me-1"></i> 5 Baru
                                    </span>
                                </div>
                                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-box fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metrik 4 -->
                <div class="col-12 col-sm-6 col-xl-3 anim-slide-up delay-4">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted fw-semibold mb-1 small text-uppercase" style="letter-spacing: 0.5px;">Pelanggan Aktif</p>
                                    <h3 class="fw-bold text-dark mb-2">892</h3>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold">
                                        <i class="fas fa-arrow-up me-1"></i> 18.2%
                                    </span>
                                </div>
                                <div class="icon-box bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-users fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Transaksi Terbaru -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 anim-slide-up delay-3">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Transaksi Terbaru</h5>
                    <a href="#" class="btn btn-sm btn-link text-decoration-none fw-bold text-success">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                <div class="card-body px-4 pb-4 pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 border-top">
                            <thead class="text-muted small text-uppercase bg-light" style="letter-spacing: 0.5px;">
                                <tr>
                                    <th class="border-bottom-0 py-3 ps-3">ID Pesanan</th>
                                    <th class="border-bottom-0 py-3">Pelanggan</th>
                                    <th class="border-bottom-0 py-3">Tanggal</th>
                                    <th class="border-bottom-0 py-3">Total</th>
                                    <th class="border-bottom-0 py-3">Status</th>
                                    <th class="border-bottom-0 py-3 text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                <tr>
                                    <td class="ps-3"><span class="fw-bold text-dark">#TRX-8821</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">NA</div>
                                            <span class="fw-medium text-dark">Nugroho Adi</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">05 Agu 2026</td>
                                    <td class="fw-bold text-dark">Rp 150.000</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold border border-warning border-opacity-25">Menunggu</span></td>
                                    <td class="text-end pe-3">
                                        <button class="btn btn-sm btn-light rounded-circle shadow-sm" title="Detail"><i class="fas fa-ellipsis-v text-muted"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-3"><span class="fw-bold text-dark">#TRX-8820</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">BS</div>
                                            <span class="fw-medium text-dark">Budi Santoso</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">04 Agu 2026</td>
                                    <td class="fw-bold text-dark">Rp 75.000</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold border border-success border-opacity-25">Selesai</span></td>
                                    <td class="text-end pe-3">
                                        <button class="btn btn-sm btn-light rounded-circle shadow-sm" title="Detail"><i class="fas fa-ellipsis-v text-muted"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection