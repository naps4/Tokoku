@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
        <a href="{{ route('admin.products.index') }}" class="btn btn-light shadow-sm me-3 rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left text-muted"></i>
        </a>
        <div>
            <h3 class="fw-bold text-dark mb-1">Tambah Produk Baru</h3>
            <p class="text-muted small mb-0">Lengkapi formulir di bawah ini untuk menambahkan barang ke etalase toko.</p>
        </div>
    </div>

    <!-- Form Tambah Produk -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <!-- PERHATIAN: Tambahkan enctype="multipart/form-data" untuk upload file -->
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nama Produk -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-dark">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg bg-light border-0 rounded-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Beras Premium 5Kg" required>
                            @error('name') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <!-- Harga -->
                            <div class="col-md-6 mb-4">
                                <label for="price" class="form-label fw-bold small text-dark">Harga (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">Rp</span>
                                    <input type="number" class="form-control form-control-lg bg-light border-0 rounded-end-3 @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="0" min="0" required>
                                </div>
                                @error('price') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                            </div>

                            <!-- Stok -->
                            <div class="col-md-6 mb-4">
                                <label for="stock" class="form-label fw-bold small text-dark">Jumlah Stok <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-lg bg-light border-0 rounded-3 @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0" min="0" required>
                                @error('stock') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="category_id" class="form-label fw-bold small text-dark">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg bg-light border-0 rounded-3 @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                        </div>

                        <!-- Deskripsi Produk (Baru ditambahkan) -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold small text-dark">Deskripsi Produk</label>
                            <textarea class="form-control bg-light border-0 rounded-3 @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Tuliskan spesifikasi atau detail produk di sini...">{{ old('description') }}</textarea>
                            @error('description') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                        </div>

                        <!-- Upload Gambar Produk (Baru ditambahkan) -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold small text-dark">Gambar Produk</label>
                            <input type="file" class="form-control form-control-lg bg-light border-0 rounded-3 @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <div class="form-text small text-muted">Format yang diizinkan: JPG, JPEG, PNG. Maksimal ukuran: 2MB.</div>
                            @error('image') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                        </div>

                        <hr class="my-4 opacity-25">

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
                            <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4 fw-bold">
                                <i class="fas fa-save me-2"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection