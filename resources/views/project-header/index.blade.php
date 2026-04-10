@extends('layouts.app')
@section('title', 'Project Header')
@section('page-title', 'Project Header')

@section('content')
<div class="card p-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Daftar Project</h6>
        <a href="{{ route('project-header.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Project
        </a>
    </div>

    <table id="table-project" class="table table-hover w-100">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Aplikasi</th>
                <th>Versi</th>
                <th>Developer</th>
                <th>PRPK</th>
                <th>MEMO</th>
                <th>Tgl Testing</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $('#table-project').DataTable({
        ajax: {
            url: '{{ route("project-header.datatable") }}'
            , type: 'GET'
            , dataSrc: 'data'
        }
        , columns: [{
                data: null
                , render: (d, t, r, m) => m.row + 1
            }
            , {
                data: 'application_name'
                , render: d => `<span class="fw-medium">${d}</span>`
            }
            , {
                data: 'program_version'
                , render: d => `<span class="badge bg-secondary">${d}</span>`
            }
            , {
                data: 'developer'
            }
            , {
                data: 'prpk'
                , render: d => d !== '-' ? `<span class="badge badge-prpk">${d}</span>` : '-'
            }
            , {
                data: 'memo'
                , render: d => d !== '-' ? `<span class="badge badge-memo">${d}</span>` : '-'
            }
            , {
                data: 'test_date'
            }
            , {
                data: 'id'
                , render: id => `
            <a href="/project-header/${id}" class="btn btn-sm btn-info text-white">
                <i class="bi bi-eye"></i>
            </a>
            <a href="/project-header/${id}/edit" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>
            <form action="/project-header/${id}" method="POST" class="d-inline"
                  onsubmit="return confirm('Hapus project ini?')">
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
