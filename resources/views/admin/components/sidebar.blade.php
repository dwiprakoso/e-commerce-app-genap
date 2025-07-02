<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-text mx-3">E-Commerce Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider"> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Management
    </div> --}}

    <!-- Nav Item - Paket Wisata -->
    <li class="nav-item {{ Request::is('admin/paket-wisata*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.paket-wisata.index') }}">
            <i class="fas fa-suitcase-rolling"></i>
            <span>Paket Wisata</span>
        </a>
    </li>

    <!-- Nav Item - Gallery -->
    <li class="nav-item {{ Request::is('admin/gallery*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.gallery.index') }}">
            <i class="fas fa-image"></i>
            <span>Gallery</span>
        </a>
    </li>

    <!-- Nav Item - Video -->
    <li class="nav-item {{ Request::is('admin/video*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.video.index') }}">
            <i class="fas fa-video"></i>
            <span>Video</span>
        </a>
    </li>

    <!-- Nav Item - Berita -->
    <li class="nav-item {{ Request::is('admin/berita*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.berita.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>Berita</span>
        </a>
    </li>

    <!-- Nav Item - Pemesanan -->
    <li class="nav-item {{ Request::is('admin/pemesanan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pemesanan.index') }}">
            <i class="fas fa-receipt"></i>
            <span>Pemesanan</span>
        </a>
    </li>

    <!-- Nav Item - Member -->
    <li class="nav-item {{ Request::is('admin/member*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.member.index') }}">
            <i class="fas fa-users"></i>
            <span>Member</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->
