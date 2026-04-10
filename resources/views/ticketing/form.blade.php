@extends('layouts.app')
@section('title', $ticket ? 'Edit Tiket' : 'Tambah Tiket')
@section('page-title', $ticket ? 'Edit Tiket' : 'Tambah Tiket')

@section('content')
<div class="card p-4" style="max-width:600px;">
    <form action="{{ $ticket ? route('ticketing.update', $ticket) : route('ticketing.store') }}" method="POST">
        @csrf
        @if($ticket) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Nomor Tiket</label>
                <input type="text" name="ticket_number" class="form-control @error('ticket_number') is-invalid @enderror" value="{{ old('ticket_number', $ticket?->ticket_number) }}" placeholder="PRPK-0001">
                @error('ticket_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Tipe Tiket</label>
                <select name="ticket_type" class="form-select @error('ticket_type') is-invalid @enderror">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="PRPK" {{ old('ticket_type', $ticket?->ticket_type) == 'PRPK' ? 'selected' : '' }}>PRPK</option>
                    <option value="MEMO" {{ old('ticket_type', $ticket?->ticket_type) == 'MEMO' ? 'selected' : '' }}>MEMO</option>
                </select>
                @error('ticket_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Subject</label>
                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject', $ticket?->subject) }}">
                @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Deskripsi</label>
                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Opsional...">{{ old('description', $ticket?->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('ticketing.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
