@extends('layouts.admin')

@section('content')
<style>
    body { background-color: #f8f9fa; }
    .anim-fade-in { animation: fadeIn 0.5s ease-out forwards; opacity: 0; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="container-fluid px-4 py-4 anim-fade-in">
    <!-- Header dan Tombol Kembali -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-light shadow-sm rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>
            <div>
                <h3 class="fw-bold text-dark mb-0">Detail Pesanan</h3>
                <div class="text-muted small mt-1">
                    ID Pesanan: <span class="fw-bold text-success">{{ $order->order_number }}</span>
                </div>
            </div>
        </div>
        
        <!-- Status Badge di Header -->
        <div>
            @if($order->status == 'menunggu')
                <span class="badge bg-warning bg-opacity-10 text-warning px-4 py-2 rounded-pill fw-bold fs-6 border border-warning border-opacity-25"><i class="fas fa-clock me-2"></i> Menunggu</span>
            @elseif($order->status == 'diproses')
                <span class="badge bg-info bg-opacity-10 text-info px-4 py-2 rounded-pill fw-bold fs-6 border border-info border-opacity-25"><i class="fas fa-box me-2"></i> Diproses</span>
            @elseif($order->status == 'dikirim')
                <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill fw-bold fs-6 border border-primary border-opacity-25"><i class="fas fa-truck me-2"></i> Dikirim</span>
            @else
                <span class="badge bg-success bg-opacity-10 text-success px-4 py-2 rounded-pill fw-bold fs-6 border border-success border-opacity-25"><i class="fas fa-check me-2"></i> Selesai</span>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <!-- Kolom Kiri: Info Pesanan & Daftar Produk -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fas fa-shopping-cart text-muted me-2"></i> Rincian Belanja</h5>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Area Daftar Produk (Placeholder Sementara) -->
                    <div class="alert alert-light border border-light-subtle rounded-3 d-flex align-items-center p-4 mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="fas fa-info-circle fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Catatan Developer:</h6>
                            <p class="text-muted small mb-0">Tabel detail item produk (seperti Nama Barang, Qty, Harga Satuan) belum dibuat di database. Nantinya tabel item pesanan akan muncul di area ini.</p>
                        </div>
                    </div>

                    <hr class="opacity-25 mb-4">

                    <!-- Ringkasan Biaya -->
                    <div class="row justify-content-end">
                        <div class="col-md-6 col-lg-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal Produk</span>
                                <span class="fw-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Ongkos Kirim</span>
                                <span class="fw-medium">Rp 0</span>
                            </div>
                            <hr class="opacity-25 my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark fs-5">Total Pembayaran</span>
                                <span class="fw-bold text-success fs-5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Kolom Kanan: Info Pelanggan & Waktu -->
        <div class="col-lg-4">
            
            <!-- Alert Sukses (Muncul jika status berhasil diubah) -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Kartu Update Status (BARU) -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 border-top border-success border-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-sync-alt text-muted me-2"></i> Update Status Pesanan</h6>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                            <select name="status" class="form-select border-0 bg-light">
                                <option value="menunggu" {{ $order->status == 'menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>📦 Diproses</option>
                                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>🚚 Dikirim</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>❌ Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-success fw-bold px-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kartu Pelanggan (Sudah Ada Sebelumnya) -->
    </div>
</div>
@endsection