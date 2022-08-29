@extends('sb-admin/app')

@section('tittle', 'Arus Kas Keluar')
@section('kaskeluar', 'active')
@section('content')

    {!! session('sukses') !!}
    <!-- Page Heading -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Arus Kas Keluar
            </h1>
            @if ($awal)
                <a href="{{ url('/kaskeluarpdf', [$awal], [$akhir]) }}" class="btn btn-sm btn-danger mt-3"><i
                        class="fa-solid fa-download"></i> Download
                    PDF
                </a>
            @else
                <a href="{{ url('/kaskeluarpdf', []) }}" class="btn btn-sm btn-danger mt-3"><i
                        class="fa-solid fa-download"></i> Download
                    PDF
                </a>
            @endif
        </div>

        <div class="row">
            <div class="col">
                <a role="button" data-bs-toggle="modal" data-bs-target="#TambahKeluar" class="btn btn-primary mt-3"><i
                        class="fa-solid fa-plus"></i> Tambah Arus Kas
                    Keluar
                </a>
                <a class="btn bg-success mt-3  text-white ">Total
                    :
                    {{ matauangID($jumlah) }}
                </a>
            </div>
        </div>

        <form action="{{ url('/kaskeluar', []) }}" method="POST" role="kaskeluar">
            <br>
            @csrf
            <div class="container">
                <div class="row g-2">
                    <div class="col-auto">
                        <input type="text" class="form-control floating" id="deskripsi" name="deskripsi"
                            placeholder="Cari deskripsi" value="{{ $deskripsi }}">
                    </div>
                    <div class="col-auto  ">
                        <select name="sumber" id="" class="form-select">
                            <option value="" class="text-success">Kategori</option>
                            @foreach ($sumberkeluar as $row)
                                <option value="{{ $row->id }}">
                                    {{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="awal" name="awal" placeholder="Tanggal awal"
                            onfocus="(this.type='date')" value="{{ $awal }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="akhir" name="akhir" placeholder="Tanggal akhir"
                            onfocus="(this.type='date')" value="{{ $akhir }}">
                    </div>
                    <div class="col-sm-2 ">
                        <button type="submit" title="Cari" class="btn btn-success"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <div class=" col-lg-12 ">
            @if ($kaskeluar[0])
                <table class="table mt-3 table-bordered table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kaskeluar as $row)
                            <tr>
                                <th width='4%' scope="row">{{ $loop->iteration }}</th>
                                <td width='18%'>{{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                                </td>
                                <td width='11%'>
                                    @if ($row->bukti)
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#ShowImg-{{ $row->id }}"
                                            class="btn btn-sm btn-info text-white mr-1">Lihat Bukti</a>
                                        {{-- <a href="{{ asset('upload/bukti/' . $row->bukti) }}" target='_blank'
                                            rel="noopener noreferrer"
                                            class="text-decoration-none btn btn-sm btn-info text-white">Lihat
                                            Bukti</a> --}}
                                    @else
                                    @endif
                                </td>
                                <td width='12%'>{{ $row->sumberkeluar->nama }}</td>
                                <td width='14%'>{{ matauangID($row->jumlah) }}</td>
                                <td>{{ $row->deskripsi }}</td>
                                <td width='10%'>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        {{-- <a href="/kaskeluar/{{ $row->id }}"
                                            class="btn btn-sm text-white btn-info mr-1">Lihat</a> --}}
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#ShowKeluar-{{ $row->id }}"
                                            class="btn btn-sm btn-info text-white mr-1">Lihat</a>
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#UbahKeluar-{{ $row->id }}"
                                            class="btn btn-sm btn-warning text-white mr-1">Ubah</a>
                                        {{-- <a href="/kaskeluar/{{ $row->id }}/edit"
                                            class="btn btn-sm btn-warning text-white mr-1"><i
                                                class="fa-solid fa-pen-to-square"></i></a> --}}
                                        <a href="{{ url('kaskeluar/' . $row->id . '/konfirmasi', []) }}"
                                            class="btn btn-sm btn-danger ">Hapus</i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $kaskeluar->links() }}
                </div>
            @else
                <div class="alert alert-info mt-4 m-3" role="alert">
                    Anda Belum Manambahkan Data
                </div>
            @endif
        </div>
    </div>

    {{-- Tambah Arus Kas Keluar --}}
    <div class="modal fade" id="TambahKeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Arus Kas Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <small class="text-danger ms-3 fst-italic">* Wajib Diisi</small>
                </div>
                <div class="container p-3">
                    <form action="{{ url('/kaskeluar', []) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="tanggal">Masukan tanggal <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                oninvalid="this.setCustomValidity('Tanggal wajib diisi!')" oninput="setCustomValidity('')"
                                value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <small class="text-danger">Tanggal Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="bukti" class="form-label">Upload Bukti berupa Gambar <span
                                    class="text-danger">*</span></label>
                            <input class="form-control hidden" type="file" id="bukti" name="bukti" required
                                placeholder="" oninvalid="this.setCustomValidity('Bukti wajib diisi!')"
                                oninput="setCustomValidity('')">
                            @error('bukti')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="sumberkeluar">Masukan Kategori <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="sumberkeluar" required
                                oninvalid="this.setCustomValidity('Sumber wajib diisi!')" oninput="setCustomValidity('')"
                                name="sumberkeluar">
                                <option></option>
                                @foreach ($sumberkeluar as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            @error('sumberkeluar')
                                <small class="text-danger">Sumber Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="jumlah">Masukan Jumlah <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required
                                oninvalid="this.setCustomValidity('Jumlah wajib diisi!')" oninput="setCustomValidity('')"
                                type-currency="IDR" value="{{ old('jumlah') }}">
                            @error('jumlah')
                                <small class="text-danger">Jumlah Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                value="{{ old('deskripsi') }}">
                            @error('deskripsi')
                                <small class="text-danger">Deskripsi Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
                            <a href="{{ url('/kaskeluar', []) }}" class=" btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($kaskeluar as $kaskeluar)
        {{-- Edit Arus Kas Masuk --}}
        <div class="modal fade" id="UbahKeluar-{{ $kaskeluar->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Arus Kas Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <div class="card mb-3 p-3" style="max-width: 800px; border-radius: 1em">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="inner">
                                        <img src="/upload/bukti/{{ $kaskeluar->bukti }}" class="img-fluid "
                                            style="border-radius: 1em" alt="...">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <form action="{{ url('/kaskeluar', [$kaskeluar->id]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="tanggal">Masukan tanggal </label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                    value="{{ $kaskeluar->tanggal }}">
                                                @error('tanggal')
                                                    <small class="text-danger">Tanggal Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="sumberkeluar">Masukan Kategori </label>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="sumberkeluar" name="sumberkeluar" required
                                                    value="{{ $kaskeluar->sumberkeluar->nama }}">
                                                    @foreach ($sumberkeluar as $row)
                                                        @if ($row->id == $kaskeluar->id_sumberkeluar)
                                                            <option selected value="{{ $row->id }}">
                                                                {{ $row->nama }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($sumberkeluar as $row)
                                                        @if ($row->id != $kaskeluar->id_sumberkeluar)
                                                            <option value="{{ $row->id }}">{{ $row->nama }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('sumberkeluar')
                                                    <small class="text-danger">Sumber Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="bukti" class="form-label">Upload Bukti</label>
                                                <input class="form-control" type="file" id="bukti"
                                                    name="bukti">
                                                @error('bukti')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="jumlah">Masukan Jumlah </label>
                                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                    required type-currency="IDR"
                                                    value="{{ old('jumlah') ? old('jumlah') : $kaskeluar->jumlah }}">
                                                @error('jumlah')
                                                    <small class="text-danger">Jumlah Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="deskripsi">Masukan Deskripsi </label>
                                                <input type="text" class="form-control" id="deskripsi"
                                                    name="deskripsi"
                                                    value="{{ old('deskripsi') ? old('deskripsi') : $kaskeluar->deskripsi }}">
                                                @error('deskripsi')
                                                    <small class="text-danger">Deskripsi Wajib Diisi!!</small>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ubah</button>
                                                <a href=" {{ url('/kaskeluar', []) }}"
                                                    class=" btn btn-secondary">Kembali</a>
                                            </div>
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
        <div class="modal fade" id="ShowKeluar-{{ $kaskeluar->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Arus Kas Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <div class="card mb-3 p-3" style="max-width: 800px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/upload/bukti/{{ $kaskeluar->bukti }}" class="img-fluid rounded"
                                        alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <label class="m-0">Jumlah :</label>
                                        <h5 class="card-title h5 bg-success p-2 rounded ps-3 text-white">
                                            {{ matauangID($kaskeluar->jumlah) }}</h5>
                                        <label class="m-0">Kategori :</label>
                                        <h5 class="card-title h6 bg-success p-2 rounded ps-3 text-white">
                                            {{ $kaskeluar->sumberkeluar->nama }}</h5>
                                        <label class="m-0">Tanggal :</label>
                                        <h5 class="card-title h6 bg-success p-2 rounded ps-3 text-white">
                                            {{ Carbon\Carbon::parse($kaskeluar->tanggal)->translatedFormat('l, d F Y') }}
                                        </h5>
                                        <label class="m-0">Deskripsi :</label>
                                        @if ($kaskeluar->deskripsi)
                                            <p class="card-text bg-success p-2 rounded ps-3 text-white">
                                                {{ $kaskeluar->deskripsi }}
                                            </p>
                                        @else
                                            <p class="card-text bg-success p-2 rounded ps-3 text-white">
                                                Tidak ada deskripsi
                                            </p>
                                        @endif
                                        <div class=" d-flex align-items-end">
                                            <a href="{{ url('/kaskeluar', [$kaskeluar->id], '/edit') }}"
                                                class="btn btn-primary mr-1">Edit</a>
                                            <a href="{{ url('/kaskeluar', []) }}"
                                                class="btn btn-secondary mr-1">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Show Bukti --}}
        <div class="modal fade" id="ShowImg-{{ $kaskeluar->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bukti Data Arus Kas Keluar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <img src="{{ asset('upload/bukti/' . $kaskeluar->bukti) }}" alt="">
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
