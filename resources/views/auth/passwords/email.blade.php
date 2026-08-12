@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 900px; width: 100%; overflow: hidden;">
        <div class="row g-0">
            
            <!-- Sisi Kiri: Ilustrasi -->
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" style="background-color: #e8f5e9;">
                <!-- Kamu bisa menggunakan gambar yang sama atau mencari ilustrasi gembok/kunci -->
                <img src="{{ asset('images/login-illustration.png') }}" alt="Ilustrasi Lupa Password" class="img-fluid p-4">
            </div>

            <!-- Sisi Kanan: Form Lupa Password -->
            <div class="col-md-6 p-5 bg-white d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <h3 class="fw-bold mb-2" style="color: #2e7d32;">Lupa Password?</h3>
                    <p class="text-muted small">
                        Jangan khawatir. Masukkan alamat email Anda yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.
                    </p>
                </div>

                <!-- Notifikasi Sukses Kirim Email -->
                @if (session('status'))
                    <div class="alert alert-success small fw-bold rounded-3 d-flex align-items-center" role="alert" style="background-color: #d1fae5; color: #065f46; border: none;">
                        <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Input Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold small text-dark">Email Terdaftar</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control border-start-0 rounded-end-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="contoh@email.com">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Tombol Kirim (Menggunakan aksen kuning/amber) -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded-pill shadow-sm text-dark" style="background-color: #f59e0b; border: none;">
                            Kirim Tautan Reset
                        </button>
                    </div>

                    <!-- Link Kembali ke Login -->
                    <div class="text-center small mt-2">
                        <span class="text-muted">Teringat password Anda?</span> 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #10b981;">
                            Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection