@extends('layouts.app')

@section('content')
<style>
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .anim-slide-up {
        animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0; 
    }
    .anim-fade-in {
        animation: fadeIn 1s ease-out forwards;
        opacity: 0;
    }
    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <!-- 1. Tambahkan class 'anim-slide-up' pada Card utama -->
    <div class="card shadow-lg border-0 rounded-4 anim-slide-up" style="max-width: 900px; width: 100%; overflow: hidden;">
        <div class="row g-0">
            
            <!-- Sisi Kiri: Ilustrasi (Background Hijau Muda) -->
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" style="background-color: #e8f5e9;">
                <!-- 2. Tambahkan class 'anim-fade-in delay-1' pada Gambar -->
                <img src="{{ asset('images/login-illustration.png') }}" alt="Ilustrasi Toko" class="img-fluid p-4 anim-fade-in delay-1">
            </div>

            <!-- Sisi Kanan: Form Register -->
            <div class="col-md-6 p-5 bg-white anim-slide-up delay-2">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0" style="color: #2e7d32;">Login Tokoku</h3>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold small text-dark">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3">
                                <i class="fas fa-user"></i>
                            </span>
                            <input id="name" type="text" class="form-control border-start-0 rounded-end-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-dark">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control border-start-0 rounded-end-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="contoh@email.com">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Nomor Telepon -->
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold small text-dark">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input id="phone" type="text" class="form-control border-start-0 rounded-end-3 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Contoh: 081234567890">
                        </div>
                        @error('phone')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Alamat -->
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold small text-dark">Alamat Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <textarea id="address" class="form-control border-start-0 rounded-end-3 @error('address') is-invalid @enderror" name="address" required autocomplete="address" rows="3" placeholder="Masukkan alamat lengkap untuk pengiriman sembako">{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold small text-dark">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3" id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye" id="eyeIcon1"></i>
                            </span>
                            <input id="password" type="password" class="form-control border-start-0 rounded-end-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-bold small text-dark">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3" id="togglePasswordConfirm" style="cursor: pointer;">
                                <i class="fas fa-eye" id="eyeIcon2"></i>
                            </span>
                            <input id="password-confirm" type="password" class="form-control border-start-0 rounded-end-3" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                        </div>
                    </div>

                    <!-- Tombol Register -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded-pill shadow-sm text-white" style="background-color: #10b981; border: none;">
                            Daftar Sekarang
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="d-flex align-items-center mb-4">
                        <hr class="flex-grow-1 m-0">
                        <span class="mx-3 small text-muted">Atau daftar dengan</span>
                        <hr class="flex-grow-1 m-0">
                    </div>

                    <!-- Tombol Google -->
                    <div class="d-grid mb-4">
                        <a href="{{ route('google.login') }}" class="btn btn-outline-dark fw-bold rounded-pill d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="fab fa-google text-danger"></i> Google
                        </a>
                    </div>

                    <!-- Link Login -->
                    <div class="text-center small">
                        <span class="text-muted">Sudah punya akun?</span> 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #10b981;">
                            Masuk di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Fungsi Toggle Ikon Mata Ganda -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Fungsi reusable untuk toggle password
        function setupPasswordToggle(toggleId, inputId, iconId) {
            const toggleBtn = document.querySelector(toggleId);
            const inputField = document.querySelector(inputId);
            const eyeIcon = document.querySelector(iconId);

            if(toggleBtn && inputField && eyeIcon) {
                toggleBtn.addEventListener('click', function () {
                    const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                    inputField.setAttribute('type', type);
                    
                    if (type === 'password') {
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.add('fa-eye');
                    } else {
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                    }
                });
            }
        }

        // Terapkan ke field Password
        setupPasswordToggle('#togglePassword', '#password', '#eyeIcon1');
        // Terapkan ke field Konfirmasi Password
        setupPasswordToggle('#togglePasswordConfirm', '#password-confirm', '#eyeIcon2');
        
    });
</script>
@endsection