<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">SmartLib - V1</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashbor</li>
            <li @if (request()->routeIs('admin.dashboard')) class="active" @endif>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dasbor Admin</span>
                </a>
            </li>
            <li class="menu-header">Pelayanan</li>
            <li @if (request()->routeIs('admin.catalog*') || request()->routeIs('admin.category*')) class="active" @endif>
                <a href="{{ route('admin.category.index') }}" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Katalog Buku</span>
                </a>
            </li>
            <li @if (request()->routeIs('admin.loan*')) class="active" @endif>
                <a href="{{ route('admin.loan.search-student') }}" class="nav-link">
                    <i class="fas fa-book-open"></i>
                    <span>Peminjaman Buku</span>
                </a>
            </li>
            <li @if (request()->routeIs('admin.return*')) class="active" @endif>
                <a href="{{ route('admin.return.search-serial') }}" class="nav-link">
                    <i class="fas fa-hand-holding"></i>
                    <span>Pengembalian Buku</span>
                </a>
            </li>
            <li @if (request()->routeIs('admin.reservation*')) class="active" @endif>
                <a href="{{ route('admin.reservation.index') }}" class="nav-link">
                    <i class="fas fa-list-ol"></i>
                    <span>Reservasi Siswa</span>
                </a>
            </li>
            <li @if (request()->routeIs('missing*')) class="active" @endif>
                <a href="#" class="nav-link">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Laporan Kehilangan</span>
                </a>
            </li>
            <li class="menu-header">Pengguna</li>
            <li @if (request()->routeIs('admin-data*')) class="active" @endif>
                <a href="{{ route('admin-data.index') }}" class="nav-link">
                    <i class="fas fa-user-secret"></i>
                    <span>Administrator</span>
                </a>
            </li>
            <li @if (request()->routeIs('student-data*')) class="active" @endif>
                <a href="{{ route('student-data.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Siswa</span>
                </a>
            </li>
            <li class="menu-header">Utilitas</li>
            {{-- <li>
                <a href="#" class="nav-link">
                    <i class="fas fa-school"></i>
                    <span>Informasi Sekolah</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Konfigurasi Aplikasi</span>
                </a>
            </li> --}}
        </ul>
    </aside>
</div>