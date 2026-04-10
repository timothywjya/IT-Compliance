@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Project</div>
                    <div class="fw-semibold fs-5">{{ $totalProject }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-ticket-perforated"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Ticketing</div>
                    <div class="fw-semibold fs-5">{{ $totalTicketing }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-list-check"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Testing</div>
                    <div class="fw-semibold fs-5">{{ $totalTesting }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Users</div>
                    <div class="fw-semibold fs-5">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Projects --}}
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Project Terbaru</h6>
        <a href="{{ route('project-header.index') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-arrow-right me-1"></i> Lihat Semua
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Aplikasi</th>
                    <th>Versi</th>
                    <th>Developer</th>
                    <th>Tanggal Testing</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProjects as $i => $project)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="fw-medium">{{ $project->application_name }}</td>
                    <td><span class="badge bg-secondary">{{ $project->program_version }}</span></td>
                    <td>{{ $project->developer?->first_name }} {{ $project->developer?->last_name }}</td>
                    <td>{{ $project->test_date ? \Carbon\Carbon::parse($project->test_date)->format('d M Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                        Belum ada data project
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
