@extends('sb-admin/app')

@section('tittle', 'Laporan Arus Kas Masjid')
@section('lapmas', 'active')
@section('laporanketua', 'show')
@section('lapshow', 'active')
@section('content')



    <!-- Page Heading -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan Arus Kas Masjid</h1>
            @auth
                @if ($awal)
                    <a href="/lapmaspdf/{{ $awal }}/{{ $akhir }}" class="btn btn-sm btn-danger mt-3"><i
                            class="fa-solid fa-download"></i>
                        Download PDF
                    </a>
                @else
                    <a href="/lapmaspdf" class="btn btn-sm btn-danger mt-3"><i class="fa-solid fa-download"></i>
                        Download PDF
                    </a>
                @endif
            @endauth

        </div>
        <div class="col-md-10 mb-4">

            <form action="{{ route('carilaporanmas') }}" method="POST" role="carilaporanmas">
                <br>
                @csrf
                <div class="container">
                    <div class="row g-2">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="awal" name="awal"
                                placeholder="Tanggal awal" onfocus="(this.type='date')" value="{{ $awal }}">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="akhir" name="akhir"
                                placeholder="Tanggal akhir" onfocus="(this.type='date')" value="{{ $akhir }}">
                        </div>
                        <div class="col-sm-2 ">
                            <button type="submit" title="Cari" class="btn btn-success"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Example single danger button -->


            <table class="table mt-3 table-bordered table-responsive m-3">
                <thead>
                    <tr>
                        <th colspan="5">Arus Kas Masuk</th>
                    </tr>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasmasuk as $row)
                        <tr>
                            <th width='4%' scope="row">{{ $loop->iteration }}</th>
                            <td width='18%'>
                                {{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            <td width='18%'>{{ $row->sumbermasuk->nama }}</td>
                            <td width='14%'>{{ matauangID($row->jumlah) }}</td>
                            <td>{{ $row->deskripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="ms-3 mb-4">
                {{ $kasmasuk->links() }}
            </div> --}}

            <table class="table mt-3 table-bordered table-responsive m-3">
                <thead>
                    <tr>
                        <th colspan="5">Arus Kas Keluar</th>
                    </tr>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        {{-- <th scope="col">Bukti</th> --}}
                        <th scope="col">Kategori</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kaskeluar as $row)
                        <tr>
                            <th width='4%' scope="row">{{ $loop->iteration }}</th>
                            <td width='18%'>
                                {{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                            </td>
                            {{-- <td width='14%'><a href="{{ asset('upload/bukti/' . $row->bukti) }}" target='_blank'
                                    rel="noopener noreferrer" class="text-decoration-none">Lihat
                                    Bukti</a></td> --}}
                            <td width='18%'>{{ $row->sumberkeluar->nama }}</td>
                            <td width='14%'>{{ matauangID($row->jumlah) }}</td>
                            <td>{{ $row->deskripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="ms-3 mb-4">
                {{ $kaskeluar->links() }}
            </div>

            <table class="table mt-3 table-bordered table-responsive m-3">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Total Kas Masuk</th>
                        <th scope="col">Total Kas Keluar</th>
                        <th scope="col">Total Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width='4%' scope="row">1</th>
                        <td>{{ matauangID($jumlahmasuk) }}</td>
                        <td>{{ matauangID($jumlahkeluar) }}</td>
                        <td>{{ matauangID($jumlahmasuk - $jumlahkeluar) }}</td>
                    </tr>

                </tbody>
            </table>
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
