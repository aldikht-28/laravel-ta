@extends('sb-admin/app')

@section('tittle', 'Ubah Sumber Arus Kas Keluar')
@section('kaskeluar', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="container">


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Data Sumber Arus Kas Keluar</h1>
        </div>

        <div class="card mb-3 p-3" style="max-width: 800px; border-radius: 1em">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="inner">

                        <img src="/upload/bukti/{{ $kaskeluar->bukti }}" class="img-fluid " style="border-radius: 1em"
                            alt="...">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <form action="/kaskeluar/{{ $kaskeluar->id }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="tanggal">Masukan tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ $kaskeluar->tanggal }}">
                                @error('tanggal')
                                    <small class="text-danger">Tanggal Wajib Diisi!!</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sumberkeluar">Masukan Sumber</label>
                                <select class="form-select" aria-label="Default select example" id="sumberkeluar"
                                    name="sumberkeluar" value="{{ $kaskeluar->sumberkeluar->nama }}">
                                    @foreach ($sumberkeluar as $row)
                                        @if ($row->id == $kaskeluar->id_sumberkeluar)
                                            <option selected value="{{ $row->id }}">{{ $row->nama }}
                                            </option>
                                        @endif
                                    @endforeach
                                    @foreach ($sumberkeluar as $row)
                                        @if ($row->id != $kaskeluar->id_sumberkeluar)
                                            <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('sumberkeluar')
                                    <small class="text-danger">Sumber Wajib Diisi!!</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bukti" class="form-label">Upload Bukti</label>
                                <input class="form-control" type="file" id="bukti" name="bukti">
                                @error('bukti')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jumlah">Masukan Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" type-currency="IDR"
                                    value="{{ old('jumlah') ? old('jumlah') : $kaskeluar->jumlah }}">
                                @error('jumlah')
                                    <small class="text-danger">Jumlah Wajib Diisi!!</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                    value="{{ old('deskripsi') ? old('deskripsi') : $kaskeluar->deskripsi }}">
                                @error('deskripsi')
                                    <small class="text-danger">Deskripsi Wajib Diisi!!</small>
                                @enderror
                            </div>
                            {{-- <div class="d-flex justify-content-end"> --}}
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href=" /kaskeluar" class=" btn btn-secondary">Kembali</a>

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
