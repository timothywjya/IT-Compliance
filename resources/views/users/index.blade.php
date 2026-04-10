@extends('layouts.app')
@section('title', 'Master Users')
@section('page-title', 'Master Users')

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
        <h6 class="fw-semibold mb-0">Daftar User</h6>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>
    </div>

    <table id="table-users" class="table table-hover w-100">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $('#table-users').DataTable({
        ajax: {
            url: '{{ route("users.datatable") }}'
            , type: 'GET'
            , dataSrc: 'data'
        }
        , columns: [{
                data: null
                , render: (d, t, r, m) => m.row + 1
            }
            , {
                data: 'name'
            }
            , {
                data: 'nik'
            }
            , {
                data: 'username'
            }
            , {
                data: 'email'
            }
            , {
                data: 'role'
                , render: d => `<span class="badge bg-primary bg-opacity-10 text-primary">${d}</span>`
            }
            , {
                data: 'deleted_at'
                , render: d => d ?
                    `<span class="badge bg-danger">Nonaktif</span>` : `<span class="badge bg-success">Aktif</span>`
            }
            , {
                data: 'id'
                , render: id => `
            <a href="/users/${id}/edit" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="/users/${id}" method="POST" class="d-inline"
                  onsubmit="return confirm('Nonaktifkan user ini?')">
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
