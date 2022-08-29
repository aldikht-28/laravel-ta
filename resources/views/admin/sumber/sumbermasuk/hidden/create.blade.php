@extends('sb-admin/app')

@section('tittle', 'Tambah Sumber Arus Kas Masuk')
@section('sumbermasuk', 'active')
@section('sumber', 'show')
@section('sumbershow', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Sumber Arus Kas Masuk</h1>
    </div>

    <form action="/sumbermasuk" method="POST">
        @csrf
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="nama">Nama Sumber Arus Kas Masuk</label>
            <input type="text" class="form-control" id="nama" name="nama">
            @error('nama')
                <p class="text-danger">Nama Sumber Wajib Diisi!!</p>
            @enderror
        </div>
        <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
        <a href="/sumbermasuk" class=" btn btn-secondary">Kembali</a>
    </form>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
