@extends('sb-admin/app')

@section('tittle', 'Tambah Sumber Arus Kas Keluar')
@section('dokumentasi', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Dokumentasi</h1>
    </div>

    <form action="/dokumentasi/{{ $dok->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="judul">Masukan Judul</label>
            <input type="text" class="form-control" id="judul" name="judul"
                value="{{ old('judul') ? old('judul') : $dok->judul }}" required>
            @error('judul')
                <small class="text-danger">Judul Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-3">
                <img src="/upload/gambar/{{ $dok->gambar }}" height="190" class="ml-3 mb-3 " alt="">
            </div>
            <div class="col-md-6 ml-5">
                <div class="mb-3 col-lg-5">
                    <label class="form-label" for="tanggal">Masukan tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                        value="{{ old('tanggal') ? old('tanggal') : $dok->tanggal }}" required>
                    @error('tanggal')
                        <small class="text-danger">Tanggal Wajib Diisi!!</small>
                    @enderror
                </div>
                <div class="mb-3 col-lg-5">
                    <label for="gambar" class="form-label">Upload Gambar</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                    {{-- @error('gambar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror --}}
                </div>
            </div>
        </div>

        <div class="mb-3 col-lg-6">
            <label class="form-label" for="body">Masukan Keterangan</label>
            <textarea type="text" class="form-control" id="body" name="body"
                value="{{ old('body') ? old('body') : $dok->body }}" required></textarea>
            @error('body')
                <small class="text-danger">Keterangan Wajib Diisi!!</small>
            @enderror
        </div>
        <button type="submit" class="ms-3 btn btn-primary">Ubah</button>
        <a href="/dokumentasi" class=" btn btn-secondary">Kembali</a>
    </form>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
