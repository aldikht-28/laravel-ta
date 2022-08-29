@extends('sb-admin.app')
@section('tittle', 'Yayasan Al-Bahri')

@section('navbar-home')
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-success md-4 p-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href={{ url('/') }}> YAYASAN AL-BAHRI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="h6 text-white active">Selamat Datang,
                                    {{ auth()->user()->name }} <i class="fa-solid fa-angle-down"></i></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @can('bendahara')
                                    <a class="dropdown-item" href={{ url('dashboard') }}>
                                        <i class="fa-solid fa-gauge fa-sm fa-fw mr-2 text-success"></i>
                                        Dashboard
                                    </a>
                                    {{-- <div class="dropdown-divider"></div> --}}
                                @endcan
                                <a class="dropdown-item" href={{ url('/user') }}>
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-success"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-success"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    @else
                        <li class="navbar-item">
                            <a href={{ url('/laporanmasjid') }} class="nav-link active text-warning fw-bolder mr-3 text-white">
                                <i class="fa-solid fa-mosque"></i>
                                Laporan Masjid</a>
                        </li>
                        <li class="navbar-item">
                            <a href={{ url('/login') }}
                                class="btn btn-sm bg-white nav-link active fw-bolder text-success bg-warning"><i
                                    class="fa-solid fa-right-to-bracket"></i>
                                Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
@endsection


@section('body')

    <div id="carouselExampleControls" class="carousel  slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-caption d-flex flex-column justify-content-center" style="top: 0%">
                    <h1 style="font-size: 30px; font-family: 'Trebuchet MS', serif;text-shadow: 2px 2px 4px #000000">Selamat
                        Datang di <br><span
                            style="font-size: 60px; text-shadow: 4px 4px 10px gold; font-family: 'times new roman','times', serif "
                            class="text-success"> YAYASAN
                            AL-BAHRI</span>
                    </h1>
                    <div class="row">
                        <div class="d-flex justify-content-center col">
                            <a href="#profil" class="btn btn-success col-md-2 shadow mr-4">Profil</a>
                            <a href="#galeri" class="btn btn-outline-light col-md-3 shadow">Galeri</a>
                        </div>
                    </div>
                </div>
                {{-- <img src="a.jpg" alt="unsplash" class="d-block w-100" height="600px"> --}}
                <img src="https://source.unsplash.com/1600x900/?islamic/?mosque" alt="unsplash" class="d-block w-100"
                    height="600px">
            </div>

        </div>
    </div>
    {{-- <img src=/a.jpg class="d-block w-100" height="624px" alt="..."> --}}

    <div class="container">

        <section id="profil">
            <div class="container">
                <div class="row row-cols justify-content-center text-center mb-5">
                    <div class="col">
                        <h2 class="fs-3 text-white ">Profil Yayaysan Al-Bahri</h2>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row row-cols justify-content-center text-center mt-5">
                    <div class="col col-md-6 mt-5 mt-md-0">
                        <h2 class="fs-3 fw-bold mb-5">Profil Yayaysan Al-Bahri</h2>
                    </div>
                </div>
                <div class="card mb-3 shadow">
                    <div class="row g-0">
                        @foreach ($profil as $row)
                            <div class="col-md-4">
                                @if ($row->fotoprofil)
                                    <img src="upload/fotoprofil/{{ $row->fotoprofil }}" class="card-img-top" height="310px"
                                        alt="...">
                                @else
                                    <img src="{{ asset('/a.jpg') }}" class="card-img-top" height="310px" alt="...">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body fs-5">
                                    <p class="p-3 text-center">
                                        {{ $row->profily }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="col-md-4">
                            <img src="a.jpg" class="card-img-top" height="310px" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body fs-5">
                                <p class="p-3 text-center">
                                    Yayasan Al-Bahri merupakan sebuah yayasan yang terletak di Jl. Tawang Alun No.77, Dusun
                                    Sukorejo, Desa Lemahbangkulon, Kecamatan Singojuruh, Kabupaten Banyuwangi, Provinsi Jawa
                                    Timur.
                                    Yayasan
                                    ini
                                    berstatus sebagai badan Ketakmiran Masjid dan Lembaga Pendidikan. Pada Yayasan Al-Bahri
                                    memiliki 2 lembaga pendidikan yaitu Taman
                                    Pendidikan
                                    Al-Qur’an (TPQ) dan Pendidikan Anak Usia Dini (PAUD).
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
    </div>
    </section>

    <section id="galeri">
        <div class="container">
            <div class="row row-cols justify-content-center text-center">
                <div class="col">
                    <p class="fs-3 text-white  ">Galeri</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-success">
        <div class="container">
            <div class="row row-cols justify-content-center text-center mt-5 mb-5">
                <div class="col">
                    <h2 class="fs-3 text-white fw-bold mt-4">Galeri</h2>
                </div>
            </div>
            <div class="row justify-content-center " data-masonry='{"percentPosition": true }'>
                @forelse ($dokumentasi as $row)
                    {{-- This is the last iteration --}}
                    <div class="col-md-4 mb-4">
                        <div class="card shadow p-2">
                            <div class="inner">
                                <img src="upload/gambar/{{ $row->gambar }}" class="card-img-top" alt="" />
                            </div>
                            <div class="col">
                                <h5 class="card-title mt-2 mb-3 fw-bold text-center">{{ $row->judul }}</h5>
                                <p class="card-text m-2 mb-3 text-center">{{ $row->body }}</p>
                                <p class="text-end me-4 text-success">
                                    <small>{{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-primary text-center" role="alert">
                        Belum ada dokumentasi
                    </div>
                @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $dokumentasi->links() }}
        </div>
        <br>
    </section>
    <footer class="text-center text-lg-start bg-dark text-success ">
        <div class="text-center p-4 bg-white">
            © {{ now()->year }}
            Copyright:
            <a class="text-reset fw-bold text-decoration-none" href="/">Yayasan AL-BAHRI</a>
        </div>
    </footer>


@endsection
