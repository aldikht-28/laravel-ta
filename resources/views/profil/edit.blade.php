@extends('sb-admin/app')

@section('tittle', 'Ubah User Profil')
@section('user', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="container">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 pb-3 text-gray-800">Ubah Data Sumber Arus Kas Keluar</h1>
        </div>

        <div class="card mb-3 p-3" style="max-width: 800px; border-radius: 1em">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="inner">
                        <img src="/upload/foto/{{ Auth::user()->foto }}" class="img-fluid" style="border-radius: 1em"
                            alt="...">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="/user/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Masukan name</label>
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
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
