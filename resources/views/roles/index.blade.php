@extends('layouts.app')
@section('title', 'Master Roles')
@section('page-title', 'Master Roles')

@section('content')
<div class="card p-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Daftar Role</h6>
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Role
        </a>
    </div>

    <table id="table-roles" class="table table-hover w-100">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Role</th>
                <th>Total User</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $('#table-roles').DataTable({
        ajax: {
            url: '{{ route("roles.datatable") }}'
            , type: 'GET'
            , dataSrc: 'data'
        }
        , columns: [{
                data: null
                , render: (d, t, r, m) => m.row + 1
            }
            , {
                data: 'role_name'
            }
            , {
                data: 'total'
                , render: d => `<span class="badge bg-primary">${d}</span>`
            }
            , {
                data: 'created'
            }
            , {
                data: 'id'
                , render: id => `
            <a href="/roles/${id}/edit" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="/roles/${id}" method="POST" class="d-inline"
                  onsubmit="return confirm('Hapus role ini?')">
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
