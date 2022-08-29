<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">AL-BAHRI</div>
    </a>

    <!-- Divider -->
    @can('bendahara')
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @yield('dashboard')">
            <a class="nav-link" href="{{ url('/dashboard', []) }}">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Arus Kas
        </div>


        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item @yield('sumbershow')">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-file-lines"></i>
                <span> Data Kategori</span>
            </a>
            <div id="collapseTwo" class="collapse @yield('sumber')" aria-labelledby="headingTwo"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    {{-- <h6 class="collapse-header">Data Sumber</h6> --}}
                    <a class="collapse-item text-success @yield('sumbermasuk')" href="{{ url('/sumbermasuk', []) }}"><i
                            class="fa-solid fa-arrow-trend-up"></i> Arus Kas Masuk</a>
                    <a class="collapse-item text-success @yield('sumberkeluar')" href="{{ url('/sumberkeluar', []) }}"><i
                            class="fa-solid fa-arrow-trend-down"></i> Arus Kas Keluar</a>
                </div>
            </div>
        </li>


        <li class="nav-item @yield('kasmasuk')">
            <a class="nav-link" href="{{ url('/kasmasuk', []) }}">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <span> Arus Kas Masuk</span></a>
        </li>
        <li class="nav-item @yield('kaskeluar')">
            <a class="nav-link" href="{{ url('/kaskeluar', []) }}">
                <i class="fa-solid fa-arrow-trend-down"></i>
                <span> Arus Kas Keluar</span></a>
        </li>
        <li class="nav-item @yield('laporan')">
            <a class="nav-link" href="{{ url('/laporan', []) }}">
                <i class="fa-solid fa-chart-simple"></i>
                <span> Laporan Arus Kas</span></a>
        </li>
    @endcan

    @can('ketua')
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Laporan
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @yield('lapshow')">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTree"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-chart-simple"></i>
                <span> Laporan</span>
            </a>
            <div id="collapseTree" class="collapse @yield('laporanketua')" aria-labelledby="headingTwo"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item text-success @yield('lapmas')" href="{{ url('/laporanmasjid', []) }}"><i
                            class="fa-solid fa-mosque"></i> Laporan Masjid</a>
                    <a class="collapse-item text-success @yield('lappaud')" href="{{ url('/laporanpaud', []) }}"><i
                            class="fa-solid fa-school"></i> Laporan Paud</a>
                    <a class="collapse-item text-success @yield('laptpq')" href="{{ url('/laporantpq', []) }}"><i
                            class="fa-solid fa-book-quran"></i> Laporan TPQ</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Profil Yayasan
        </div>
        <li class="nav-item @yield('profilyayasan')">
            <a class="nav-link" href="{{ url('/profily', []) }}">
                <i class="fa-solid fa-address-card"></i>
                <span>Profil Yayasan</span></a>
        </li>
    @endcan

    @auth
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Dokumentasi
        </div>
        <li class="nav-item @yield('dokumentasi')">
            <a class="nav-link" href="{{ url('/dokumentasi', []) }}">
                <i class="fa-solid fa-grip"></i>
                <span>Dokumentasi</span></a>
        </li>
        <hr class="sidebar-divider">



        <!-- Heading -->
        <div class="sidebar-heading">
            Profil
        </div>


        <!-- Nav Item - Charts -->
        <li class="nav-item @yield('user')">
            <a class="nav-link" href="{{ url('/user', []) }}">
                <i class="fa-solid fa-user"></i>
                <span> Profil</span></a>
        </li>


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    @else
    @endauth



</ul>
