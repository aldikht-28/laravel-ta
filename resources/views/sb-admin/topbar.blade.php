<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            @auth
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <h6 class="mr-2 mt-2 text-success">{{ auth()->user()->name }}</h6>
                    @if (auth()->user()->foto)
                        <img class="img-profile rounded-circle" src="upload/foto/{{ Auth::user()->foto }}">
                    @else
                        <img class="img-profile rounded-circle" src=/profil.png>
                    @endif
                </a>
            @else
                <div class="d-sm-flex align-items-center ">
                    <a href="/" class="text-white btn btn-sm btn-success fw-bold text-decoration-none"><i
                            class="fa-solid fa-house-chimney-crack"></i> Kembali Ke Halaman Depan</a>
                </div>
            @endauth

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/user">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-success"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="/">
                    <i class="fas fa-home fa-sm fa-fw mr-2 text-success"></i>
                    Home
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-success"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
