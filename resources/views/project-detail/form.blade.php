@extends('layouts.app')
@section('title', $detail ? 'Edit Skenario' : 'Tambah Skenario')
@section('page-title', ($detail ? 'Edit' : 'Tambah') . ' Skenario — ' . $projectHeader->application_name)

@section('content')
<div class="card p-4" style="max-width:600px;">
    <form action="{{ $detail
        ? route('project-header.detail.update', [$projectHeader, $detail])
        : route('project-header.detail.store', $projectHeader) }}" method="POST">
        @csrf
        @if($detail) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium">Skenario Testing</label>
                <input type="text" name="testing_scenario" class="form-control @error('testing_scenario') is-invalid @enderror" value="{{ old('testing_scenario', $detail?->testing_scenario) }}" placeholder="Contoh: Login dengan username dan password valid">
                @error('testing_scenario') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Target</label>
                <input type="text" name="target" class="form-control @error('target') is-invalid @enderror" value="{{ old('target', $detail?->target) }}" placeholder="Contoh: Berhasil masuk ke halaman dashboard">
                @error('target') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Testing by Support</label>
                <select name="testing_by_support" class="form-select @error('testing_by_support') is-invalid @enderror">
                    <option value="Y" {{ old('testing_by_support', $detail?->testing_by_support) === 'Y' ? 'selected' : '' }}>Ya (Y)</option>
                    <option value="N" {{ old('testing_by_support', $detail?->testing_by_support ?? 'N') === 'N' ? 'selected' : '' }}>Tidak (N)</option>
                </select>
                @error('testing_by_support') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Testing by Programmer</label>
                <select name="testing_by_programmer" class="form-select @error('testing_by_programmer') is-invalid @enderror">
                    <option value="Y" {{ old('testing_by_programmer', $detail?->testing_by_programmer) === 'Y' ? 'selected' : '' }}>Ya (Y)</option>
                    <option value="N" {{ old('testing_by_programmer', $detail?->testing_by_programmer ?? 'N') === 'N' ? 'selected' : '' }}>Tidak (N)</option>
                </select>
                @error('testing_by_programmer') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
