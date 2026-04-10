@extends('layouts.app')
@section('title', $user ? 'Edit User' : 'Tambah User')
@section('page-title', $user ? 'Edit User' : 'Tambah User')

@section('content')
<div class="card p-4" style="max-width:640px;">
    <form action="{{ $user ? route('users.update', $user) : route('users.store') }}" method="POST">
        @csrf
        @if($user) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">First Name</label>
                <input type="text" name="first_name"
                       class="form-control @error('first_name') is-invalid @enderror"
                       value="{{ old('first_name', $user?->first_name) }}">
                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Last Name</label>
                <input type="text" name="last_name"
                       class="form-control @error('last_name') is-invalid @enderror"
                       value="{{ old('last_name', $user?->last_name) }}">
                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">NIK</label>
                <input type="text" name="nik" maxlength="10"
                       class="form-control @error('nik') is-invalid @enderror"
                       value="{{ old('nik', $user?->nik) }}">
                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Role</label>
                <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ old('role_id', $user?->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->role_name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Username</label>
                <input type="text" name="username"
                       class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username', $user?->username) }}">
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Email</label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user?->email) }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">
                    Password {{ $user ? '(kosongkan jika tidak diubah)' : '' }}
                </label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ $user ? 'Isi jika ingin mengubah password' : 'Min. 8 karakter' }}">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Ulangi password">
            </div>
            <div class="col-12">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection