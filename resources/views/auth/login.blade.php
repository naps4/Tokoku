@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 900px; width: 100%; overflow: hidden;">
        <div class="row g-0">
            
            <!-- Sisi Kiri: Ilustrasi (Background Hijau Muda) -->
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" style="background-color: #e8f5e9;">
                <!-- Ganti src dengan path gambar ilustrasi kamu -->
                <img src="{{ asset('images/login-illustration.png') }}" alt="Ilustrasi Toko" class="img-fluid p-4">
            </div>

            <!-- Sisi Kanan: Form Login -->
            <div class="col-md-6 p-5 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0" style="color: #2e7d32;">Login Tokoku</h3>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Input Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold small text-dark">Email</label>
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

                    <!-- Input Password dengan Toggle Mata -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold small text-dark">Password</label>
                        <div class="input-group">
                            <!-- ID togglePassword ditambahkan di sini -->
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3" id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                            <input id="password" type="password" class="form-control border-start-0 rounded-end-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Lupa Password (Aksen Kuning) -->
                    <div class="d-flex justify-content-end mb-4">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}" style="color: #f59e0b;">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <!-- Tombol Login (Hijau Utama) -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded-pill shadow-sm text-white" style="background-color: #10b981; border: none;">
                            Masuk
                        </button>
                    </div>

                    <!-- Divider Or Continue With -->
                    <div class="d-flex align-items-center mb-4">
                        <hr class="flex-grow-1 m-0">
                        <span class="mx-3 small text-muted">Atau masuk dengan</span>
                        <hr class="flex-grow-1 m-0">
                    </div>

                    <!-- Tombol Google Login Saja -->
                    <div class="d-grid mb-4">
                        <a href="#" class="btn btn-outline-dark fw-bold rounded-pill d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="fab fa-google text-danger"></i> Google
                        </a>
                    </div>

                    <!-- Link Register -->
                    <div class="text-center small">
                        <span class="text-muted">Belum punya akun?</span> 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #10b981;">
                            Daftar di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Fungsi Toggle Ikon Mata -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Cek apakah saat ini tipe inputnya password atau text
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Ubah ikon mata silang/terbuka
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    });
</script>
@endsection