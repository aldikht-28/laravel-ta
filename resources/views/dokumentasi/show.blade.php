@extends('sb-admin/app')

@section('tittle', 'Detail Dokumentasi')
@section('dokumentasi', 'active')
@section('content')

    <h1 class="h3 mb-3 text-gray-800">Detail Dokumentasi</h1>
    <div class="col-lg-6">
        <div class="card mb-3 ">
            <img src="/upload/gambar/{{ $dok->gambar }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $dok->judul }}</h5>
                <p class="card-text">{{ $dok->body }}</p>
                <p class="card-text"><small class="text-muted">{{ date('d F Y', strtotime($dok->tanggal)) }}</small>
                </p>
            </div>
        </div>
        <a href="/dokumentasi/edit" class="btn btn-primary mr-1">Edit</a>
        <a href="/dokumentasi" class="btn btn-secondary mr-1">Kembali</a>
    </div>
@endsection


@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
