<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion position-relative" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url ('dashboard')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('assets/img/logo.png')}}" alt="logo" width="50px">
        </div>
        <div class="sidebar-brand-text mx-1">
            <img src="{{asset('assets/img/antares-logo.png')}}" alt="logo-text" width="100px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item{{ (request()->is('dashboard')) ? ' active' : '' }}">
        <a class="nav-link" href="{{url ('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ (request()->is('device')) ? ' active' : '' }}">
        <a class="nav-link" href="{{url('device')}}">
            <i class="fas fa-solid fa-server"></i>
            <span>Device</span></a>
    </li>

    <li @if(session('roles')==2 || session('roles')==3) {{'hidden'}} @endif class="nav-item {{ (request()->is('admin')) ? ' active' : '' }}">
        <a class="nav-link" href="{{url('admin')}}">
            <i class="fas fa-solid fa-user"></i>
            <span>User Management</span></a>
    </li>

    {{session('roles')}}

    <hr class="sidebar-divider mb-3">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->