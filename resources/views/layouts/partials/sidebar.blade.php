<nav class="sidebar d-flex flex-column p-3">
    <div class="text-center py-3 mb-2">
        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-3 mb-2" style="width:44px;height:44px;">
            <i class="bi bi-layers-fill text-white fs-5"></i>
        </div>
        <div class="text-white fw-semibold">Project System</div>
        <div class="text-muted small" style="font-size:11px;">v1.0.0</div>
    </div>

    <hr class="border-secondary my-2">

    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('ticketing.index') }}" class="nav-link {{ request()->routeIs('ticketing.*') ? 'active' : '' }}">
                <i class="bi bi-ticket-perforated"></i> Master Ticketing
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('project-header.index') }}" class="nav-link {{ request()->routeIs('project-header.*') ? 'active' : '' }}">
                <i class="bi bi-folder2-open"></i> Project Header
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Master Users
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i> Master Roles
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
