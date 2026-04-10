@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="w-100" style="max-width: 440px; padding: 0 16px;">

        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-3 mb-3"
                 style="width:52px; height:52px;">
                <i class="bi bi-layers-fill text-white fs-4"></i>
            </div>
            <h4 class="fw-semibold mb-1">Selamat Datang</h4>
            <p class="text-muted small">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <div class="card auth-card p-4">

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-medium">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-person text-muted"></i>
                        </span>
                        <input type="text"
                               name="username"
                               class="form-control border-start-0 @error('username') is-invalid @enderror"
                               placeholder="Masukkan username"
                               value="{{ old('username') }}"
                               autocomplete="username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-lock text-muted"></i>
                        </span>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                               placeholder="Masukkan password">
                        <button class="btn btn-light border" type="button" id="togglePassword">
                            <i class="bi bi-eye text-muted" id="eyeIcon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary py-2 fw-medium">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                    </button>
                </div>

            </form>
        </div>

        <p class="text-center text-muted small mt-3">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary fw-medium text-decoration-none">Daftar sekarang</a>
        </p>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input   = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
</script>
@endpush