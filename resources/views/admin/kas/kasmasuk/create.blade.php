@extends('sb-admin/app')

@section('tittle', 'Tambah Sumber Arus Kas Masuk')
@section('kasmasuk', 'active')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Sumber Arus Kas Masuk</h1>
    </div>

    <form action="/kasmasuk" method="POST">
        @csrf
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="tanggal">Masukan tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
            @error('tanggal')
                <small class="text-danger">tanggal Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="sumbermasuk">Masukan Sumber</label>
            <select class="form-select" aria-label="Default select example" id="sumbermasuk" name="sumbermasuk">
                <option selected>Pilih Sumber Arus Kas Masuk</option>
                @foreach ($sumbermasuk as $row)
                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                @endforeach
            </select>
            @error('sumbermasuk')
                <small class="text-danger">Sumber Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="jumlah">Masukan Jumalah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" type-currency="IDR">
            @error('jumlah')
                <small class="text-danger">Jumlah Wajib Diisi!!</small>
            @enderror
        </div>
        <div class="mb-3 col-lg-6">
            <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
            @error('deskripsi')
                <small class="text-danger">Deskripsi Wajib Diisi!!</small>
            @enderror
        </div>
        <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
        <a href="/kasmasuk" class=" btn btn-secondary">Kembali</a>
    </form>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
                element.addEventListener('keyup', function(e) {
                    let cursorPostion = this.selectionStart;
                    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                    let originalLenght = this.value.length;
                    if (isNaN(value)) {
                        this.value = "";
                    } else {
                        this.value = value.toLocaleString('id-ID', {
                            currency: 'IDR',
                            style: 'currency',
                            minimumFractionDigits: 0
                        });
                        cursorPostion = this.value.length - originalLenght + cursorPostion;
                        this.setSelectionRange(cursorPostion, cursorPostion);
                    }
                });
            });
        })
    </script> --}}
@endsection
