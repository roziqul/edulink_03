
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">SmartLib - V1</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dasbor</li>
            <li @if (request()->routeIs('student.dashboard')) class="active" @endif>
                <a href="{{ route('student.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dasbor Siswa</span>
                </a>
            </li>
            <li class="menu-header">Pelayanan</li>
            <li @if (request()->routeIs('student.catalog*')) class="active" @endif>
                <a href="{{ route('student.catalog.index') }}" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>Katalog</span>
                </a>
            </li>
            {{-- <li class="nav-item dropdown @if (request()->routeIs('catalog*') || request()->routeIs('section*') || request()->routeIs('category*')) active @endif">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Katalog</span>
                </a>
                <ul class="dropdown-menu">
                    <li @if (request()->routeIs('catalog*')) class="active" @endif>
                        <a class="nav-link" href="{{ route('catalog.index') }}">
                            Buku
                        </a>
                    </li>
                    <li @if (request()->routeIs('category*')) class="active" @endif>
                        <a class="nav-link" href="{{ route('category.index') }}">
                            Kategori
                        </a>
                    </li>
                    <li @if (request()->routeIs('section*')) class="active" @endif>
                        <a class="nav-link" href="{{ route('section.index') }}">
                            Section
                        </a>
                    </li>
                </ul>
            </li> --}}
            <li @if (request()->routeIs('student.reservation*')) class="active" @endif>
                <a href="{{ route('student.reservation.index') }}" class="nav-link">
                    <i class="fas fa-book-open"></i>
                    <span>Pengajuan Peminjaman</span>
                </a>
            </li>
            {{-- <li @if (request()->routeIs('student.missing*')) class="active" @endif>
                <a href="{{ route('student.missing.create') }}" class="nav-link">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Pengajuan Kehilangan</span>
                </a>
            </li> --}}
        </ul>
    </aside>
</div>
