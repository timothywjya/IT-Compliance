<div class="topbar d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-semibold mb-0">@yield('page-title', 'Dashboard')</h5>
        <small class="text-muted">@yield('page-subtitle', now()->isoFormat('dddd, D MMMM YYYY'))</small>
    </div>
    <div class="d-flex align-items-center gap-3">
        <div class="text-end">
            <div class="fw-medium small">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
            <div class="text-muted" style="font-size:11px;">{{ auth()->user()->role->role_name ?? '-' }}</div>
        </div>
        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-semibold" style="width:38px;height:38px;">
            {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
        </div>
    </div>
</div>
