@extends('sb-admin/app')

@section('tittle', 'User profil')
@section('user', 'active')
@section('content')

    <!-- Page Heading -->
    <div class="container">
        <div class="mb-4">
            <h1 class="h3 pb-4 text-gray-800">Profil</h1>
        </div>
        <div class="text-center">
            @if (auth()->user()->foto)
                <img class="img-profile" style="width: 26%; border-radius: 1rem" src="upload/foto/{{ Auth::user()->foto }}">
            @else
                <img class="img-profile rounded-circle" width="26%" src=/profil.png>
            @endif

        </div>

        <div class="pt-4 d-flex justify-content-center ">
            <div class="p-2 bg-success bg-success text-white p text-center col-lg-6" style=" border-radius: 1rem">
                {{ Auth::user()->name }}
            </div>
        </div>
        <div class="pt-3 d-flex justify-content-center">
            <div class="p-2 bg-success bg-success text-white p text-center col-lg-6" style=" border-radius: 1rem">
                {{ Auth::user()->email }}
            </div>
        </div>
        <hr width="600" class="divider  ms-auto mx-auto bg-success">
        <div class="d-flex justify-content-center pt">
            <p>
                Apakah anda ingin merubah profil?
            </p>
            <a role="button" data-bs-toggle="modal" data-bs-target="#UbahProfil-{{ Auth::user()->id }}"
                class="text-decoration-none text-success"><span> Ubah Profil</span></a>
        </div>
    </div>

    <div class="modal fade" id="UbahProfil-{{ Auth::user()->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container p-3">
                    <div class="card mb-3 p-3" style="max-width: 800px; border-radius: 1em">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="inner">
                                    <img src="/upload/foto/{{ Auth::user()->foto }}" class="img-fluid "
                                        style="border-radius: 1em" alt="...">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <form action="/user/{{ Auth::user()->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Masukan nama</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ Auth::user()->name }}">
                                            @error('name')
                                                <small class="text-danger">name Wajib Diisi!!</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Masukan email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ Auth::user()->email }}">
                                            @error('name')
                                                <small class="text-danger">name Wajib Diisi!!</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Upload foto</label>
                                            <input class="form-control" type="file" id="foto" name="foto">
                                            @error('foto')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                        <a href="/user" class=" btn btn-secondary">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
