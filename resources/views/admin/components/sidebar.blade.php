<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">E-Commerce Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>
    <!-- Nav Item - Kategori -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.paket-wisata.index') }}" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
            <span>Paket Wisata</span>
        </a>
    </li>
    <!-- Nav Item - Produk -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.gallery.index') }}" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
            <span>Gallery</span>
        </a>
    </li>
    <!-- Nav Item - Konsumen -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.video.index') }}" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
            <span>Video</span>
        </a>
    </li>
    <!-- Nav Item - Order -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.berita.index') }}" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
            <span>Berita</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.pemesanan.index') }}" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pemesanan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.member.index') }}" aria-expanded="true">
            <i class="fas fa-fw fa-cog"></i>
            <span>Member</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Report
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
