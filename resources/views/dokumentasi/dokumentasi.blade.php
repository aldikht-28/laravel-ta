@extends('sb-admin/app')

@section('tittle', 'Dokumentasi')
@section('dokumentasi', 'active')
@section('content')

    <!-- Page Heading -->
    <div class="container">
        <h1 class="h3 mb-0 text-gray-800">Daftar Dokumentasi</h1>
        <a role="button" data-bs-toggle="modal" data-bs-target="#TambahDok" class="btn btn-primary mt-5 ms-3"><i
                class="fa-solid fa-plus"></i> Tambah
            Dokumentasi
        </a>
        <form action="/dokumentasi" method="POST" role="dokumentasi">
            <br>
            @csrf
            <div class="container">
                <div class="row g-2">
                    <div class="col-auto">
                        <input type="text" class="form-control floating" id="judul" name="judul"
                            placeholder="Cari judul" value="">
                    </div>
                    <div class="col-sm-2 ">
                        <button type="submit" title="Cari" class="btn btn-success"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="mb-4 col-md-12">
            @if ($dokumentasi[0])
                <table class="table mt-3  table-bordered  table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Gambar</th>
                            {{-- <th scope="col">Keterangan</th> --}}
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumentasi as $row)
                            <tr>
                                <th width='2%' scope="row">{{ $loop->iteration }}</th>
                                <td width='13%'>{{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                                </td>
                                {{-- <td width='10%'><img src="upload/bukti/{{ $row->bukti }}" width="80px" alt=""></td> --}}
                                <td width='15%'>{{ $row->judul }}</td>
                                <td width='4%'>
                                    <a role="button" data-bs-toggle="modal" data-bs-target="#ShowImg-{{ $row->id }}"
                                        class="btn btn-sm btn-info text-white mr-1">Lihat Gambar</a>
                                    {{-- <a href="{{ asset('upload/gambar/' . $row->gambar) }}" target='_blank'
                                        rel="noopener noreferrer"
                                        class="text-decoration-none btn btn-sm btn-info text-white">Lihat
                                        Gambar</a> --}}
                                </td>
                                {{-- <td width='20%'>{{ $row->body }}</td> --}}
                                <td width='1%'>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        {{-- <a href="/dokumentasi/{{ $row->id }}"
                                            class="btn btn-sm text-white btn-info mr-1">Lihat</a> --}}
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#ShowDok-{{ $row->id }}"
                                            class="btn btn-sm btn-info text-white mr-1">Lihat</a>
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#UbahDok-{{ $row->id }}"
                                            class="btn btn-sm btn-warning text-white mr-1">Ubah</a>
                                        <a href="/dokumentasi/{{ $row->id }}/konfirmasi"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-3 mt-4">
                    {{ $dokumentasi->links() }}
                </div>
            @else
                <div class="alert alert-info mt-4 m-3" role="alert">
                    Anda Belum Manambahkan Data
                </div>
            @endif
        </div>
    </div>

    {{-- Tambah Arus Dok --}}
    <div class="modal fade" id="TambahDok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dokumentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <small class="text-danger ms-3 fst-italic">* Wajib Diisi</small>
                </div>
                <div class="container p-3">
                    <form action="/dokumentasi" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="tanggal">Masukan tanggal <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <small class="text-danger">Tanggal Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="judul">Masukan Judul <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="{{ old('judul') }}" required>
                            @error('judul')
                                <small class="text-danger">Judul Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="gambar" class="form-label">Upload Gambar <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                            @error('gambar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="body">Masukan Keterangan</label>
                            <textarea type="text" class="form-control" id="body" name="body" value="{{ old('body') }}" required></textarea>
                            @error('body')
                                <small class="text-danger">Keterangan Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
                            <a href="/dokumentasi" class=" btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($dokumentasi as $dok)
        {{-- Edit Arus Kas Masuk --}}
        <div class="modal fade" id="UbahDok-{{ $dok->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Dokumentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <div class="card mb-3 p-3" style="max-width: 800px; border-radius: 1em">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="inner">
                                        <img src="/upload/gambar/{{ $dok->gambar }}" class="img-fluid "
                                            style="border-radius: 1em" alt="...">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <form action="/dokumentasi/{{ $dok->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3 col-lg-12">
                                                <label class="form-label" for="judul">Masukan Judul </label>
                                                <input type="text" class="form-control" id="judul" name="judul"
                                                    value="{{ $dok->judul }}" required>
                                                @error('judul')
                                                    <small class="text-danger">Judul Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-12">
                                                <label class="form-label" for="tanggal">Masukan tanggal </label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                    value="{{ $dok->tanggal }}" required>
                                                @error('tanggal')
                                                    <small class="text-danger">Tanggal Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-12">
                                                <label for="gambar" class="form-label">Upload Gambar</label>
                                                <input class="form-control" type="file" id="gambar"
                                                    name="gambar">
                                                @error('gambar')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-12">
                                                <label class="form-label" for="body">Masukan Keterangan</label>
                                                <input type="text" class="form-control" id="body" name="body"
                                                    required value="{{ $dok->body }}">
                                                @error('body')
                                                    <small class="text-danger">Keterangan Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <button type="submit" class="ms-3 btn btn-primary">Ubah</button>
                                            <a href="/dokumentasi" class=" btn btn-secondary">Kembali</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Show Arus Kas Masuk --}}
        <div class="modal fade" id="ShowDok-{{ $dok->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Dokumentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <div class="col-lg-12">
                            <div class="card mb-3 ">
                                <img src="/upload/gambar/{{ $dok->gambar }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $dok->judul }}</h5>
                                    <p class="card-text">{{ $dok->body }}</p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ date('d F Y', strtotime($dok->tanggal)) }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a role="button" data-bs-toggle="modal" data-bs-target="#UbahDok-{{ $row->id }}"
                            class="btn btn-primary mr-1">Edit</a>
                        <a href="/dokumentasi" class="btn btn-secondary mr-1">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ShowImg-{{ $dok->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Gambar dokumentasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <img src="{{ asset('upload/gambar/' . $dok->gambar) }}" alt="">
                </div>
            </div>
        </div>
    @endforeach


@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection
