@extends('sb-admin/app')

@section('tittle', 'Ubah Data Arus Kas Masuk')
@section('kasmasuk', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Arus Kas Masuk</h1>
    </div>

    <form action="/kasmasuk/{{ $kasmasuk->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="tanggal">Masukan tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kasmasuk->tanggal }}">
            @error('tanggal')
                <small class="text-danger">tanggal Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="sumbermasuk">Masukan Sumber</label>
            <select class="form-select" aria-label="Default select example" id="sumbermasuk" name="sumbermasuk"
                value="{{ $kasmasuk->sumbermasuk->nama }}">
                @foreach ($sumbermasuk as $row)
                    @if ($row->id == $kasmasuk->id_sumbermasuk)
                        <option selected value="{{ $row->id }}">{{ $row->nama }}</option>
                    @endif
                @endforeach
                @foreach ($sumbermasuk as $row)
                    @if ($row->id != $kasmasuk->id_sumbermasuk)
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                    @endif
                @endforeach
            </select>
            @error('sumbermasuk')
                <small class="text-danger">Sumber Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="jumlah">Masukan Jumalah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $kasmasuk->jumlah }}">
            @error('jumlah')
                <small class="text-danger">Jumlah Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $kasmasuk->deskripsi }}">
            @error('deskripsi')
                <small class="text-danger">Deskripsi Wajib Diisi!!</small>
            @enderror
        </div>
        <button type="submit" class="ms-3 btn btn-primary">Ubah</button>
        <a href="/kasmasuk" class=" btn btn-secondary">Kembali</a>
    </form>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
