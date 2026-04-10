@extends('layouts.app')
@section('title', $project ? 'Edit Project' : 'Tambah Project')
@section('page-title', $project ? 'Edit Project' : 'Tambah Project')

@section('content')
<div class="card p-4">
    <form action="{{ $project ? route('project-header.update', $project) : route('project-header.store') }}" method="POST">
        @csrf
        @if($project) @method('PUT') @endif

        {{-- Section: Informasi Dasar --}}
        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">Informasi Dasar</h6>
        <div class="row g-3 mb-4">
            <div class="col-md-8">
                <label class="form-label fw-medium">Nama Aplikasi</label>
                <input type="text" name="application_name" class="form-control @error('application_name') is-invalid @enderror" value="{{ old('application_name', $project?->application_name) }}">
                @error('application_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Versi Program</label>
                <input type="text" name="program_version" class="form-control @error('program_version') is-invalid @enderror" value="{{ old('program_version', $project?->program_version) }}" placeholder="v1.0.0">
                @error('program_version') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Developer</label>
                <select name="developed_by" class="form-select @error('developed_by') is-invalid @enderror">
                    <option value="">-- Pilih Developer --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('developed_by', $project?->developed_by) == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                    @endforeach
                </select>
                @error('developed_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Tanggal Testing</label>
                <input type="datetime-local" name="test_date" class="form-control @error('test_date') is-invalid @enderror" value="{{ old('test_date', $project?->test_date ? \Carbon\Carbon::parse($project->test_date)->format('Y-m-d\TH:i') : '') }}">
                @error('test_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Section: PRPK --}}
        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">Data PRPK</h6>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tiket PRPK</label>
                <select name="prpk_id" class="form-select @error('prpk_id') is-invalid @enderror">
                    <option value="">-- Pilih PRPK --</option>
                    @foreach($ticketing->where('ticket_type','PRPK') as $t)
                    <option value="{{ $t->id }}" {{ old('prpk_id', $project?->prpk_id) == $t->id ? 'selected' : '' }}>
                        {{ $t->ticket_number }} - {{ $t->subject }}
                    </option>
                    @endforeach
                </select>
                @error('prpk_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">PIC PRPK</label>
                <select name="pic_prpk" class="form-select @error('pic_prpk') is-invalid @enderror">
                    <option value="">-- Pilih PIC --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('pic_prpk', $project?->pic_prpk) == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                    @endforeach
                </select>
                @error('pic_prpk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Nama PIC PRPK</label>
                <input type="text" name="name_pic_prpk" class="form-control @error('name_pic_prpk') is-invalid @enderror" value="{{ old('name_pic_prpk', $project?->name_pic_prpk) }}">
                @error('name_pic_prpk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Section: MEMO --}}
        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">Data MEMO</h6>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tiket MEMO</label>
                <select name="memo_id" class="form-select @error('memo_id') is-invalid @enderror">
                    <option value="">-- Pilih MEMO --</option>
                    @foreach($ticketing->where('ticket_type','MEMO') as $t)
                    <option value="{{ $t->id }}" {{ old('memo_id', $project?->memo_id) == $t->id ? 'selected' : '' }}>
                        {{ $t->ticket_number }} - {{ $t->subject }}
                    </option>
                    @endforeach
                </select>
                @error('memo_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">PIC MEMO</label>
                <select name="pic_memo" class="form-select @error('pic_memo') is-invalid @enderror">
                    <option value="">-- Pilih PIC --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('pic_memo', $project?->pic_memo) == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                    @endforeach
                </select>
                @error('pic_memo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Nama PIC MEMO</label>
                <input type="text" name="name_pic_memo" class="form-control @error('name_pic_memo') is-invalid @enderror" value="{{ old('name_pic_memo', $project?->name_pic_memo) }}">
                @error('name_pic_memo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Section: Testing --}}
        <h6 class="fw-semibold text-primary mb-3 border-bottom pb-2">Tim Testing</h6>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-medium">Developer Testing</label>
                <select name="developer_testing" class="form-select @error('developer_testing') is-invalid @enderror">
                    <option value="">-- Pilih Developer --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('developer_testing', $project?->developer_testing) == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                    @endforeach
                </select>
                @error('developer_testing') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Support Testing</label>
                <select name="support_testing" class="form-select @error('support_testing') is-invalid @enderror">
                    <option value="">-- Pilih Support --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('support_testing', $project?->support_testing) == $user->id ? 'selected' : '' }}>
                        {{ $user->first_name }} {{ $user->last_name }}
                    </option>
                    @endforeach
                </select>
                @error('support_testing') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
            <a href="{{ route('project-header.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
