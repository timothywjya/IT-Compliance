@extends('layouts.app')
@section('title', $role ? 'Edit Role' : 'Tambah Role')
@section('page-title', $role ? 'Edit Role' : 'Tambah Role')

@section('content')
<div class="card p-4" style="max-width:500px;">
    <form action="{{ $role ? route('roles.update', $role) : route('roles.store') }}" method="POST">
        @csrf
        @if($role) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label fw-medium">Nama Role</label>
            <input type="text" name="role_name" class="form-control @error('role_name') is-invalid @enderror" value="{{ old('role_name', $role?->role_name) }}" placeholder="Contoh: Developer">
            @error('role_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
