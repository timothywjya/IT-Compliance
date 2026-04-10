@extends('layouts.app')
@section('title', 'Master Ticketing')
@section('page-title', 'Master Ticketing')

@section('content')
<div class="card p-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Daftar Tiket</h6>
        <a href="{{ route('ticketing.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Tiket
        </a>
    </div>

    <table id="table-ticketing" class="table table-hover w-100">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>No. Tiket</th>
                <th>Tipe</th>
                <th>Subject</th>
                <th>Deskripsi</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $('#table-ticketing').DataTable({
        ajax: '{{ route("ticketing.index") }}?dt=1'
        , columns: [{
                data: null
                , render: (d, t, r, m) => m.row + 1
            }
            , {
                data: 'ticket_number'
                , render: d => `<span class="fw-medium">${d}</span>`
            }
            , {
                data: 'ticket_type'
                , render: d => d === 'PRPK' ?
                    `<span class="badge badge-prpk">PRPK</span>` :
                    `<span class="badge badge-memo">MEMO</span>`
            }
            , {
                data: 'subject'
            }
            , {
                data: 'description'
                , render: d => d ? `<span class="text-muted small">${d.substring(0,60)}...</span>` : '-'
            }
            , {
                data: 'created_at'
            }
            , {
                data: 'id'
                , render: id => `
            <a href="/ticketing/${id}/edit" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="/ticketing/${id}" method="POST" class="d-inline"
                  onsubmit="return confirm('Hapus tiket ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>`
            }
        ]
        , language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
    });

</script>
@endpush
