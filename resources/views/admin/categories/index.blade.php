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
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box-open me-3 w-20px text-center"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-tags me-3 w-20px text-center"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item mt-3 mb-1">
                        <small class="text-white-50 text-uppercase fw-bold px-3" style="font-size: 0.7rem; letter-spacing: 1px;">Transaksi</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">
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

        <!-- Konten Utama Kategori -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 anim-fade-in">
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Manajemen Kategori</h3>
                    <p class="text-muted small mb-0">Kelola pengelompokan produk untuk toko Anda.</p>
                </div>
                <button class="btn btn-success shadow-sm rounded-pill px-4 fw-bold d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </button>
            </div>

            <!-- Alert Notifikasi -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Tabel Kategori -->
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase" style="letter-spacing: 0.5px;">
                                <tr>
                                    <th class="py-3 ps-4 rounded-start-3">Nama Kategori</th>
                                    <th class="py-3">Slug (URL)</th>
                                    <th class="py-3 text-center">Jumlah Produk</th>
                                    <th class="py-3 text-end pe-4 rounded-end-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                <tr class="hover-shadow">
                                    <td class="ps-4 fw-bold text-dark py-3">{{ $category->name }}</td>
                                    <td class="text-muted small">{{ $category->slug }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $category->products_count > 0 ? 'bg-primary' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                            {{ $category->products_count }} Produk
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm rounded-pill">
                                            <!-- Tombol Edit (Memicu Modal Edit) -->
                                            <button type="button" class="btn btn-sm btn-light text-primary border-0 px-3" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light text-danger border-0 px-3">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit Kategori (Satu untuk setiap baris) -->
                                <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="fw-bold">Edit Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-2">
                                                        <label class="form-label fw-bold small text-dark">Nama Kategori</label>
                                                        <input type="text" class="form-control form-control-lg bg-light border-0 rounded-3" name="name" value="{{ $category->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-tags fs-1 mb-3 opacity-50"></i>
                                            <h5 class="fw-bold">Belum ada kategori</h5>
                                            <p>Silakan klik tombol "Tambah Kategori" untuk memulai.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($categories->hasPages())
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-end rounded-bottom-4">
                    {{ $categories->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>
</div>

<!-- Modal Tambah Kategori Baru (Berada di luar Row/Main) -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg bg-light border-0 rounded-3" name="name" placeholder="Contoh: Sayuran" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4"><i class="fas fa-save me-2"></i> Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection