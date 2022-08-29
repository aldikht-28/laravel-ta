@extends('sb-admin/app')

@section('tittle', 'Arus Kas Masuk')
@section('kasmasuk', 'active')
@section('content')



    <!-- Page Heading -->
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Arus Kas Masuk</h1>
            @if ($awal)
                <a href="{{ url('/kasmasukpdf', [$awal], [$akhir]) }}" class="btn btn-sm btn-danger mt-3"><i
                        class="fa-solid fa-download"></i> Download PDF
                </a>
            @else
                <a href="{{ url('/kasmasukpdf', []) }}" class="btn btn-sm btn-danger mt-3"><i class="fa-solid fa-download"></i>
                    Download PDF
                </a>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <a role="button" data-bs-toggle="modal" data-bs-target="#TambahMasuk" class="btn btn-primary mt-3"><i
                        class="fa-solid fa-plus"></i> Tambah Arus Kas Masuk
                </a>
                <a class="btn bg-success mt-3  text-white fw-normal ">Total
                    :
                    {{ matauangID($jumlah) }}
                </a>
            </div>
        </div>

        <form action="{{ url('/kasmasuk', []) }}" method="post">
            <br>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="row g-2">
                            <div class="col-auto">
                                <input type="text" class="form-control floating" id="deskripsi" name="deskripsi"
                                    placeholder="Cari deskripsi" value="{{ $deskripsi }}">
                            </div>
                            <div class="col-auto  ">
                                <select name="sumber" id="" class="form-select">
                                    <option value="{{ $sumber }}" class="text-success">Kategori</option>
                                    @foreach ($sumbermasuk as $row)
                                        <option value="{{ $row->id }}">
                                            {{ $row->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="awal" name="awal"
                                    placeholder="Tanggal awal" onfocus="(this.type='date')" value="{{ $awal }}">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="akhir" name="akhir"
                                    placeholder="Tanggal akhir" onfocus="(this.type='date')" value="{{ $akhir }}">
                            </div>
                            <div class="col-sm-2 ">
                                <button type="submit" title="Cari" class="btn btn-success"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
        <div class="col-lg-12">

            @if ($kasmasuk[0])
                <table class="table mt-3 table-bordered table-responsive ">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kasmasuk as $row)
                            <tr>
                                <th width='5%' scope="row">{{ $loop->iteration }}</th>
                                <td width='18%'>
                                    {{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                                </td>
                                <td width='18%'>{{ $row->sumbermasuk->nama }}</td>
                                <td width='14%'>{{ matauangID($row->jumlah) }}</td>
                                <td>{{ $row->deskripsi }}</td>
                                <td width='10%'>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        {{-- <a href="/kasmasuk/{{ $row->id }}"
                                            class="btn btn-sm text-white btn-info mr-1">Lihat</a> --}}
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#ShowMasuk-{{ $row->id }}"
                                            class="btn btn-sm btn-info text-white mr-1">Lihat</a>
                                        <a role="button" data-bs-toggle="modal"
                                            data-bs-target="#UbahMasuk-{{ $row->id }}"
                                            class="btn btn-sm btn-warning text-white mr-1">Ubah</a>
                                        <a href="{{ url('kasmasuk/' . $row->id . '/konfirmasi') }}"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <h6 class="h6 mb-0 bg-success p-2 rounded text-white ml-4 justify-content-end">{{ matauangID($jumlah) }} --}}
                </h6>
                <div class=" mt-4">
                    {{ $kasmasuk->links() }}
                </div>
            @else
                <div class="alert alert-info mt-4 m-3" role="alert">
                    Anda Belum Manambahkan Data
                </div>
            @endif
        </div>
    </div>

    {{-- Tambah Arus Kas Masuk --}}
    <div class="modal fade" id="TambahMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Arus Kas Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <small class="text-danger ms-3 fst-italic">* Wajib Diisi</small>
                </div>
                <div class="container p-3">
                    <form action="{{ url('/kasmasuk', []) }}" method="POST">
                        @csrf
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="tanggal">Masukan tanggal <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                oninvalid="this.setCustomValidity('Tanggal Wajib Diisi!!')"
                                oninput="setCustomValidity('')">
                            @error('tanggal')
                                <small class="text-danger">tanggal Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="sumbermasuk">Masukan Kategori <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="sumbermasuk" required
                                oninvalid="this.setCustomValidity('Kategori Wajib Diisi!!')"
                                oninput="setCustomValidity('')" name="sumbermasuk">
                                <option></option>
                                @foreach ($sumbermasuk as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                            @error('sumbermasuk')
                                <small class="text-danger">Kategori Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="jumlah">Masukan Jumalah <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required
                                oninvalid="this.setCustomValidity('Jumlah Wajib Diisi!!')" oninput="setCustomValidity('')"
                                type-currency="IDR">
                            @error('jumlah')
                                <small class="text-danger">Jumlah Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                            @error('deskripsi')
                                <small class="text-danger">Deskripsi Wajib Diisi!!</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
                            <a href="/kasmasuk" class=" btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($kasmasuk as $kasmasuk)
        {{-- Edit Arus Kas Masuk --}}
        <div class="modal fade" id="UbahMasuk-{{ $kasmasuk->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Arus Kas Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <form action="{{ url('kasmasuk/' . $kasmasuk->id . '/') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="tanggal">Masukan tanggal </label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ $kasmasuk->tanggal }}">
                                @error('tanggal')
                                    <small class="text-danger">tanggal Wajib Diisi!!</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="sumbermasuk">Masukan Kategori </label>
                                <select class="form-select" aria-label="Default select example" id="sumbermasuk"
                                    name="sumbermasuk" value="{{ $kasmasuk->sumbermasuk->nama }}">
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
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="jumlah">Masukan Jumalah </label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    value="{{ $kasmasuk->jumlah }}">
                                @error('jumlah')
                                    <small class="text-danger">Jumlah Wajib Diisi!!</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="deskripsi">Masukan Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                    value="{{ $kasmasuk->deskripsi }}">
                                @error('deskripsi')
                                    <small class="text-danger">Deskripsi Wajib Diisi!!</small>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="ms-3 btn btn-primary">Ubah</button>
                                <a href="/kasmasuk" class=" btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Show Arus Kas Masuk --}}
        <div class="modal fade" id="ShowMasuk-{{ $kasmasuk->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Arus Kas Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <div class="card mb-3 p-3" style="max-width: 800px;">
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
                                            {{ Carbon\Carbon::parse($kasmasuk->tanggal)->translatedFormat('l, d F Y') }}
                                        </p>
                                        <label class="m-0">Deskripsi :</label>
                                        @if ($kasmasuk->deskripsi)
                                            <p class="card-text bg-success p-2 rounded ps-3 text-white">
                                                {{ $kasmasuk->deskripsi }} </p>
                                        @else
                                            <p class="card-text bg-success p-2 rounded ps-3 text-white">
                                                Tidak ada deskripsi </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" d-flex align-items-end">
                            <a role="button" data-bs-toggle="modal" data-bs-target="#UbahMasuk-{{ $row->id }}"
                                class="btn btn-primary mr-1">Edit</a>
                            <a href="/kasmasuk/" class="btn btn-secondary mr-1">Kembali</a>
                        </div>
                    </div>
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
