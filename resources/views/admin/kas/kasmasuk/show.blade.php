@extends('sb-admin/app')

@section('tittle', 'Detail Arus Kas Masuk')
@section('kasmasuk', 'active')

@section('content')

    <div class="container">
        <div class="mb-4 ">
            <h1 class="h3 mb-0 text-gray-800">Detail Arus Kas Masuk</h1>
        </div>
        <div class="card mb-3 p-3" style="max-width: 600px;">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="card-body">
                        <label class="m-0">Jumlah :</label>
                        <h5 class="card-title h5 bg-success p-2 rounded ps-3 text-white">
                            {{ matauangID($kasmasuk->jumlah) }}</h5>
                        <label class="m-0">Sumber :</label>
                        <p class="card-title p bg-success p-2 rounded ps-3 text-white">
                            {{ $kasmasuk->sumbermasuk->nama }}</p>
                        <label class="m-0">Tanggal :</label>
                        <p class="card-title p bg-success p-2 rounded ps-3 text-white">
                            {{ Carbon\Carbon::parse($kasmasuk->tanggal)->translatedFormat('l, d F Y') }}</p>
                        <label class="m-0">Deskripsi :</label>
                        <p class="card-text bg-success p-2 rounded ps-3 text-white">{{ $kasmasuk->deskripsi }} </p>
                        <div class=" d-flex align-items-end">
                            <a href="" class="btn btn-primary mr-1">Edit</a>
                            <a href="/kasmasuk" class="btn btn-secondary mr-1">Kembali</a>
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
