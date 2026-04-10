@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Sidebar --}}
<nav class="sidebar d-flex flex-column p-3">
    <div class="text-center py-3 mb-3">
        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-3 mb-2" style="width:44px; height:44px;">
            <i class="bi bi-layers-fill text-white fs-5"></i>
        </div>
        <div class="text-white fw-semibold">Project System</div>
        <div class="text-muted small" style="font-size:11px;">v1.0.0</div>
    </div>

    <hr class="border-secondary my-2">

    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <i class="bi bi-grid"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-ticket-perforated"></i> Master Ticketing
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-folder2-open"></i> Project Header
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-info-circle"></i> Project Information
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-list-check"></i> Project Detail
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-people"></i> Master Users
            </a>
        </li>
    </ul>

    <hr class="border-secondary my-2">

    <form action="{{ route('logout.post') }}" method="POST">
        @csrf
        <button type="submit" class="btn w-100 text-start nav-link text-danger">
            <i class="bi bi-box-arrow-left me-2"></i> Logout
        </button>
    </form>
</nav>

{{-- Main Content --}}
<div class="main-content">

    {{-- Topbar --}}
    <div class="topbar d-flex align-items-center justify-content-between">
        <div>
            <h5 class="fw-semibold mb-0">Dashboard</h5>
            <small class="text-muted">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</small>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end">
                <div class="fw-medium small">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                <div class="text-muted" style="font-size:11px;">{{ auth()->user()->role->role_name ?? '-' }}</div>
            </div>
            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-semibold" style="width:38px; height:38px;">
                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
            </div>
        </div>
    </div>

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
                        <div class="fw-semibold fs-5">{{ $totalProject ?? 0 }}</div>
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
                        <div class="fw-semibold fs-5">{{ $totalTicketing ?? 0 }}</div>
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
                        <div class="fw-semibold fs-5">{{ $totalTesting ?? 0 }}</div>
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
                        <div class="fw-semibold fs-5">{{ $totalUsers ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Projects --}}
    <div class="card border-0 rounded-3 shadow-sm">
        <div class="card-header bg-white border-0 pt-3 pb-0">
            <h6 class="fw-semibold mb-0">Project Terbaru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Aplikasi</th>
                            <th>Versi</th>
                            <th>Developer</th>
                            <th>Tanggal Testing</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProjects ?? [] as $i => $project)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-medium">{{ $project->application_name }}</td>
                            <td><span class="badge bg-secondary">{{ $project->program_version }}</span></td>
                            <td>{{ $project->developer->first_name ?? '-' }}</td>
                            <td>{{ $project->test_date ? \Carbon\Carbon::parse($project->test_date)->format('d M Y') : '-' }}</td>
                            <td><span class="badge bg-success-subtle text-success">Active</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                Belum ada data project
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
