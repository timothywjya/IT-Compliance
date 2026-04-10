@extends('layouts.app')
@section('title', 'Detail Project')
@section('page-title', $projectHeader->application_name)
@section('page-subtitle', 'Detail lengkap project')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">

    {{-- Project Header Info --}}
    <div class="col-12">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="fw-semibold mb-0">Informasi Project</h6>
                <a href="{{ route('project-header.edit', $projectHeader) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">Nama Aplikasi</small>
                    <span class="fw-medium">{{ $projectHeader->application_name }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Versi</small>
                    <span class="badge bg-secondary">{{ $projectHeader->program_version }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Developer</small>
                    <span>{{ $projectHeader->developer?->first_name }} {{ $projectHeader->developer?->last_name }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">PRPK</small>
                    <span class="badge badge-prpk">{{ $projectHeader->prpk?->ticket_number ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">PIC PRPK</small>
                    <span>{{ $projectHeader->name_pic_prpk ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">MEMO</small>
                    <span class="badge badge-memo">{{ $projectHeader->memo?->ticket_number ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">PIC MEMO</small>
                    <span>{{ $projectHeader->name_pic_memo ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Developer Testing</small>
                    <span>{{ $projectHeader->developerTesting?->first_name }} {{ $projectHeader->developerTesting?->last_name ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Support Testing</small>
                    <span>{{ $projectHeader->supportTesting?->first_name }} {{ $projectHeader->supportTesting?->last_name ?? '-' }}</span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Tanggal Testing</small>
                    <span>{{ $projectHeader->test_date ? \Carbon\Carbon::parse($projectHeader->test_date)->format('d M Y H:i') : '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Project Information --}}
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0">Informasi Teknis</h6>
                @if($projectHeader->information)
                <a href="{{ route('project-header.information.edit', [$projectHeader, $projectHeader->information]) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>
                @else
                <a href="{{ route('project-header.information.create', $projectHeader) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah
                </a>
                @endif
            </div>
            @if($projectHeader->information)
            @php $info = $projectHeader->information @endphp
            <div class="row g-2">
                <div class="col-12">
                    <small class="text-muted d-block">Kebutuhan</small>
                    <p class="mb-0 small">{{ $info->needs ?? '-' }}</p>
                </div>
                <div class="col-6">
                    <small class="text-muted d-block">Lokasi</small>
                    <span class="badge {{ $info->location === 'Server' ? 'bg-info' : 'bg-secondary' }}">
                        {{ $info->location }}
                    </span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Konfigurasi</small>
                    <span class="small">{{ $info->configuration ?? '-' }}</span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Kondisi Khusus</small>
                    <span class="small">{{ $info->special_condition ?? '-' }}</span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Dependency</small>
                    <span class="small">{{ $info->dependency ?? '-' }}</span>
                </div>
            </div>
            @else
            <p class="text-muted small mb-0">Belum ada informasi teknis.</p>
            @endif
        </div>
    </div>

    {{-- Project Detail / Testing Scenarios --}}
    <div class="col-12">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0">Skenario Testing</h6>
                <a href="{{ route('project-header.detail.create', $projectHeader) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Skenario
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="table-detail">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Skenario Testing</th>
                            <th>Target</th>
                            <th class="text-center">By Support</th>
                            <th class="text-center">By Programmer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projectHeader->details as $i => $detail)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $detail->testing_scenario }}</td>
                            <td class="text-muted small">{{ $detail->target ?? '-' }}</td>
                            <td class="text-center">
                                @if($detail->testing_by_support === 'Y')
                                <span class="badge bg-success">Y</span>
                                @else
                                <span class="badge bg-secondary">N</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($detail->testing_by_programmer === 'Y')
                                <span class="badge bg-success">Y</span>
                                @else
                                <span class="badge bg-secondary">N</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('project-header.detail.edit', [$projectHeader, $detail]) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('project-header.detail.destroy', [$projectHeader, $detail]) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus skenario ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                Belum ada skenario testing
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

@push('scripts')
<script>
    $('#table-detail').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
        , paging: false
        , searching: false
        , info: false
    , });

</script>
@endpush
