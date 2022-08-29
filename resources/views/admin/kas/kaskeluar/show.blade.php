@extends('sb-admin/app')

@section('tittle', 'Detail Arus Kas Keluar')
@section('kaskeluar', 'active')
@section('content')

    <div class="container">
        <div class="mb-4 ">
            <h1 class="h3 mb-0 text-gray-800">Detail Arus Kas Keluar</h1>
        </div>
        <div class="card mb-3 p-3" style="max-width: 800px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/upload/bukti/{{ $data->bukti }}" class="img-fluid rounded" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <label class="m-0">Jumlah :</label>
                        <h5 class="card-title h5 bg-success p-2 rounded ps-3 text-white">
                            {{ matauangID($data->jumlah) }}</h5>
                        <label class="m-0">Sumber :</label>
                        <h5 class="card-title h6 bg-success p-2 rounded ps-3 text-white">
                            {{ $data->sumberkeluar->nama }}</h5>
                        <label class="m-0">Tanggal :</label>
                        <h5 class="card-title h6 bg-success p-2 rounded ps-3 text-white">
                            {{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, d F Y') }}</h5>
                        <label class="m-0">Deskripsi :</label>
                        <p class="card-text bg-success p-2 rounded ps-3 text-white">{{ $data->deskripsi }} </p>
                        <div class=" d-flex align-items-end">
                            <a href="/kaskeluar/{{ $data->id }}/edit" class="btn btn-primary mr-1">Edit</a>
                            <a href="/kaskeluar" class="btn btn-secondary mr-1">Kembali</a>
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
