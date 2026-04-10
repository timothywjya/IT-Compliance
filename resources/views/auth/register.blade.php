@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="w-100" style="max-width: 520px; padding: 0 16px;">

        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-3 mb-3" style="width:52px; height:52px;">
                <i class="bi bi-layers-fill text-white fs-4"></i>
            </div>
            <h4 class="fw-semibold mb-1">Buat Akun Baru</h4>
            <p class="text-muted small">Lengkapi data berikut untuk mendaftar</p>
        </div>

        <div class="card auth-card p-4">

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label fw-medium">First Name</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="John" value="{{ old('first_name') }}">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Last Name</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Doe" value="{{ old('last_name') }}">
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">NIK</label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="10 digit NIK" maxlength="10" value="{{ old('nik') }}">
                        @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="johndoe" value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="john@example.com" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control border-end-0 @error('password') is-invalid @enderror" placeholder="Min. 8 karakter">
                            <button class="btn btn-light border" type="button" id="togglePassword">
                                <i class="bi bi-eye text-muted" id="eyeIcon"></i>
                            </button>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-end-0" placeholder="Ulangi password">
                            <button class="btn btn-light border" type="button" id="toggleConfirm">
                                <i class="bi bi-eye text-muted" id="eyeIconConfirm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium">Role</label>
                        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->role_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-2">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-medium">
                                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <p class="text-center text-muted small mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary fw-medium text-decoration-none">Masuk di sini</a>
        </p>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleVis(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
    document.getElementById('togglePassword').addEventListener('click', () => toggleVis('password', 'eyeIcon'));
    document.getElementById('toggleConfirm').addEventListener('click', () => toggleVis('password_confirmation', 'eyeIconConfirm'));

</script>
@endpush
