@extends('layouts.app')
@section('title', 'Informasi Teknis')
@section('page-title', 'Informasi Teknis — ' . $projectHeader->application_name)

@section('content')
<div class="card p-4" style="max-width:640px;">
    <form action="{{ $info
        ? route('project-header.information.update', [$projectHeader, $info])
        : route('project-header.information.store', $projectHeader) }}" method="POST">
        @csrf
        @if($info) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium">Kebutuhan</label>
                <textarea name="needs" rows="3" class="form-control @error('needs') is-invalid @enderror" placeholder="Deskripsi kebutuhan project...">{{ old('needs', $info?->needs) }}</textarea>
                @error('needs') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Lokasi</label>
                <select name="location" class="form-select @error('location') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="Server" {{ old('location', $info?->location) === 'Server' ? 'selected' : '' }}>Server</option>
                    <option value="Local" {{ old('location', $info?->location) === 'Local'  ? 'selected' : '' }}>Local</option>
                </select>
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Konfigurasi</label>
                <input type="text" name="configuration" class="form-control @error('configuration') is-invalid @enderror" value="{{ old('configuration', $info?->configuration) }}" placeholder="PHP 8.2, Laravel 11, MySQL 8.0">
                @error('configuration') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Kondisi Khusus</label>
                <input type="text" name="special_condition" class="form-control @error('special_condition') is-invalid @enderror" value="{{ old('special_condition', $info?->special_condition) }}">
                @error('special_condition') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Dependency</label>
                <input type="text" name="dependency" class="form-control @error('dependency') is-invalid @enderror" value="{{ old('dependency', $info?->dependency) }}" placeholder="Laravel Sanctum, Spatie, dll">
                @error('dependency') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('project-header.show', $projectHeader) }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
