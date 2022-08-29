@extends('sb-admin/app')

@section('tittle', 'Tambah Sumber Arus Kas Keluar')
@section('kaskeluar', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Sumber Arus Kas Keluar</h1>
    </div>

    <form action="/kaskeluar" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="tanggal">Masukan tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            @error('tanggal')
                <small class="text-danger">Tanggal Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label for="bukti" class="form-label">Upload Bukti</label>
            <input class="form-control" type="file" id="bukti" name="bukti">
            @error('bukti')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="sumberkeluar">Masukan Sumber</label>
            <select class="form-select" aria-label="Default select example" id="sumberkeluar" name="sumberkeluar">
                <option></option>
                @foreach ($sumberkeluar as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
            </select>
            @error('sumberkeluar')
                <small class="text-danger">Sumber Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="jumlah">Masukan Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" type-currency="IDR"
                value="{{ old('jumlah') }}">
            @error('jumlah')
                <small class="text-danger">Jumlah Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
            @error('deskripsi')
                <small class="text-danger">Deskripsi Wajib Diisi!!</small>
            @enderror
        </div>
        <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
        <a href="/kaskeluar" class=" btn btn-secondary">Kembali</a>
    </form>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
