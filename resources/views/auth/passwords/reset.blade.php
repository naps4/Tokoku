@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 900px; width: 100%; overflow: hidden;">
        <div class="row g-0">
            
            <!-- Sisi Kiri: Ilustrasi -->
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center" style="background-color: #e8f5e9;">
                <img src="{{ asset('images/login-illustration.png') }}" alt="Ilustrasi Reset Password" class="img-fluid p-4">
            </div>

            <!-- Sisi Kanan: Form Reset Password -->
            <div class="col-md-6 p-5 bg-white d-flex flex-column justify-content-center">
                <div class="mb-4">
                    <h3 class="fw-bold mb-2" style="color: #2e7d32;">Buat Password Baru</h3>
                    <p class="text-muted small">
                        Silakan masukkan password baru Anda di bawah ini untuk memulihkan akses ke akun Tokoku.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Token Wajib dari Laravel -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-dark">Email Anda</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <!-- Value email biasanya otomatis terisi dari link reset -->
                            <input id="email" type="email" class="form-control border-start-0 rounded-end-3 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Password Baru -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold small text-dark">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3" id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye" id="eyeIcon1"></i>
                            </span>
                            <input id="password" type="password" class="form-control border-start-0 rounded-end-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" autofocus>
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password Baru -->
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-bold small text-dark">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted rounded-start-3" id="togglePasswordConfirm" style="cursor: pointer;">
                                <i class="fas fa-eye" id="eyeIcon2"></i>
                            </span>
                            <input id="password-confirm" type="password" class="form-control border-start-0 rounded-end-3" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded-pill shadow-sm text-white" style="background-color: #10b981; border: none;">
                            Simpan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Fungsi Toggle Ikon Mata Ganda -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        setupPasswordToggle('#togglePassword', '#password', '#eyeIcon1');
        setupPasswordToggle('#togglePasswordConfirm', '#password-confirm', '#eyeIcon2');
    });
</script>
@endsection