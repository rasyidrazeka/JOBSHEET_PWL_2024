<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link">
        <img src="{{ asset('bahan_gambar/LOGO.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Rasyyy Coffee</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <div class="d-block" style="color: #c2c7d0">{{ auth()->user()->nama_lengkap }}</div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    @if (($activeMenu == 'penjualan') | ($activeMenu == 'riwayatPenjualan'))
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>Manajemen Penjualan<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @else
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-cash-register"></i>
                            <p>Manajemen Penjualan<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @endif

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/penjualan/create') }}"
                                class="nav-link {{ $activeMenu == 'penjualan' ? 'active' : '' }}">
                                <p>Tambah Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayatPenjualan') }}"
                                class="nav-link {{ $activeMenu == 'riwayatPenjualan' ? 'active' : '' }}">
                                <p>Riwayat Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    @if (($activeMenu == 'produk') | ($activeMenu == 'stok') | ($activeMenu == 'kategori'))
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                            <p>Manajemen Inventaris<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @else
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                            <p>Manajemen Inventaris<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @endif
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/kategori') }}"
                                class="nav-link {{ $activeMenu == 'kategori' ? 'active' : '' }}">
                                <p>Pengelolaan Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/produk') }}"
                                class="nav-link {{ $activeMenu == 'produk' ? 'active' : '' }}">
                                <p>Pengelolaan Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/stok') }}"
                                class="nav-link {{ $activeMenu == 'stok' ? 'active' : '' }}">
                                <p>Pengelolaan Stok</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    @if (($activeMenu == 'customer') | ($activeMenu == 'riwayatTransaksi'))
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>Manajemen Pelanggan<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @else
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>Manajemen Pelanggan<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @endif
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/customer') }}"
                                class="nav-link {{ $activeMenu == 'customer' ? 'active' : '' }}">
                                <p>Pengelolaan Pelanggan</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ url('/riwayatTransaksi') }}"
                                class="nav-link {{ $activeMenu == 'riwayatTransaksi' ? 'active' : '' }}">
                                <p>Riwayat Transaksi</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-chart-simple"></i>
                        <p>Laporan<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/laporanPenjualan') }}"
                                class="nav-link {{ $activeMenu == 'laporanPenjualan' ? 'active' : '' }}">
                                <p>Laporan Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/produkTerlaris') }}"
                                class="nav-link {{ $activeMenu == 'produkTerlaris' ? 'active' : '' }}">
                                <p>Produk Terlaris</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    @if (($activeMenu == 'user') | ($activeMenu == 'role'))
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>Manajemen Pengguna<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @else
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>Manajemen Pengguna<i class="fas fa-angle-left right"></i></p>
                        </a>
                    @endif
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user') }}"
                                class="nav-link {{ $activeMenu == 'user' ? 'active' : '' }}">
                                <p>Pengelolaan Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/role') }}"
                                class="nav-link {{ $activeMenu == 'role' ? 'active' : '' }}">
                                <p>Pengelolaan Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <hr style="border-color: #c2c7d0">
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa-solid fa-door-open"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
