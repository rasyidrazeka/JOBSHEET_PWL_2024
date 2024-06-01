<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}"
                    id="side-dashboard">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/administrasi') }}"
                    class="nav-link {{ $activeMenu == 'administrasi' ? 'active' : '' }}" id="side-administrasi">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <p>Administrasi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/barang') }}" class="nav-link {{ $activeMenu == 'barang' ? 'active' : '' }}"
                    id="side-barang">
                    <i class="nav-icon fa-solid fa-warehouse"></i>
                    <p>Data Barang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/transaksiMasuk') }}"
                    class="nav-link {{ $activeMenu == 'transaksiMasuk' ? 'active' : '' }}" id="side-transaksiMasuk">
                    <i class="nav-icon fa-solid fa-circle-down"></i>
                    <p>Transaksi Masuk</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/transaksiKeluar') }}"
                    class="nav-link {{ $activeMenu == 'transaksiKeluar' ? 'active' : '' }}" id="side-transaksiKeluar">
                    <i class="nav-icon fa-solid fa-circle-up"></i>
                    <p>Transaksi keluar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/pelaporan') }}" class="nav-link {{ $activeMenu == 'pelaporan' ? 'active' : '' }}"
                    id="side-pelaporan">
                    <i class="nav-icon fa-solid fa-file-lines"></i>
                    <p>Pelaporan</p>
                </a>
            </li>
            <li>
                <hr>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST" id="side-logout">
                    @csrf
                    <button type="submit" class="btn {{ $activeMenu == 'logout' ? 'active' : '' }}">
                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <i class="nav-icon fa-solid fa-right-from-bracket col"></i>
                            </div>
                            <div class="col d-flex align-items-center p-0">
                                Logout
                            </div>
                        </div>
                    </button>
                </form>
                {{-- <a href="{{ url('/logout') }}" class="nav-link {{ $activeMenu == 'logout' ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                    <p>Logout</p>
                </a> --}}
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
