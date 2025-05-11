<style>
   /* Warna dasar untuk sidebar */
.left-sidebar {
    background-color: #7d82ed; /* Warna ungu kebiruan */
    color: #ffffff; /* Warna teks putih */
    height: 100%;
    position: fixed;
    width: 250px;
}

/* Warna untuk teks link */
.left-sidebar .sidebar-nav .sidebar-link {
    color: #ffffff; /* Teks putih */
    text-decoration: none;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

/* Warna saat hover */
.left-sidebar .sidebar-nav .sidebar-link:hover {
    background-color: #5c62c5; /* Warna ungu kebiruan lebih gelap */
    color: #ffffff; /* Teks tetap putih */
}

/* Warna untuk item yang dipilih */
.left-sidebar .sidebar-nav .selected {
    background-color: #5c62c5; /* Warna lebih gelap untuk item terpilih */
    color: #ffffff; /* Teks putih */
}

/* Warna untuk logo */
.left-sidebar .brand-logo {
    background-color: #5258ba; /* Warna ungu kebiruan pekat */
    padding: 20px;
    text-align: center;
    color: white;
    font-weight: bold;
    border-bottom: 1px solid #5c62c5;
}

/* Warna untuk divider */
.left-sidebar .nav-small-cap {
    color: #d9dcfa; /* Warna ungu kebiruan terang */
    font-size: 12px;
    text-transform: uppercase;
    margin: 20px 0 10px 20px;
}


</style>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img mx-auto">
                <span style="font-size: 22px; font-weight: bold; color: white">Tabungan Siswa</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ request()->is('dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->level == 'Siswa')
                <li class="sidebar-item {{ request()->is('siswa') ? 'selected' : '' }}">
                    <a class="sidebar-link" href="{{ route('siswa.history') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-history"></i>
                        </span>
                        <span class="hide-menu">Riwayat</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->level == 'Admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data Master</span>
                    </li>
                    <li class="sidebar-item {{ request()->is('pengguna*') ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('pengguna.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Pengguna</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('siswa') ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('siswa.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Siswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('walas') ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('walas.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Wali Kelas</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Transaksi</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('pembayaran*') ? 'selected' : '' }}"
                            href="{{ route('pembayaran.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-credit-card-pay"></i>
                            </span>
                            <span class="hide-menu">Pembayaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('penarikan') ? 'selected' : '' }}"
                            href="{{ route('penarikan.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-credit-card-refund"></i>
                            </span>
                            <span class="hide-menu">Penarikan</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Riwayat</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('history') ? 'selected' : '' }}"
                            href="{{ route('siswa.historyallsiswa') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-history"></i>
                            </span>
                            <span class="hide-menu">Riwayat Transaksi</span>
                        </a>
                    </li>
                @endif
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
