@extends('sb-admin/app')

@section('tittle', 'Sumber Keluar')
@section('sumberkeluar', 'active')
@section('sumber', 'show')
@section('sumbershow', 'active')

@section('content')

    {!! session('sukses') !!}
    <!-- Page Heading -->
    <div class=" col-lg-7  mb-4 ">
        <h1 class="h3 mb-0 text-gray-800">Data Kategori Arus Kas Keluar</h1>

        <a role="button" data-bs-toggle="modal" data-bs-target="#TambahSumberKeluar" class="btn btn-primary mt-5 ms-3"><i
                class="fa-solid fa-plus"></i> Tambah Kategori Arus Kas
            Keluar
        </a>

        @if ($sumberkeluar[0])
            <table class="table mt-3 table-bordered m-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sumberkeluar as $row)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $row->nama }}</td>
                            <td width='8%'>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    {{-- <a href="/sumberkeluar/{{ $row->id }}/edit"
                                        class="btn btn-sm btn-warning text-white mr-1"><i
                                            class="fa-solid fa-pen-to-square"></i></a> --}}
                                    <a role="button" data-bs-toggle="modal"
                                        data-bs-target="#UbahSumberKeluar-{{ $row->id }}"
                                        class="btn btn-sm btn-warning text-white mr-1">Ubah</a>
                                    <a href="{{ url('sumberkeluar/' . $row->id . '/konfirmasi') }}"
                                        class="btn btn-sm btn-danger">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-3 mt-4">
                {{ $sumberkeluar->links() }}
            </div>
        @else
            <div class="alert alert-info mt-4 m-3" role="alert">
                Anda Belum Manamhkan Data
            </div>
        @endif
    </div>

    {{-- Tambah Sumber Kas Keluar --}}
    <div class="modal fade" id="TambahSumberKeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori Arus Kas Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/sumberkeluar', []) }}" method="POST">
                    @csrf
                    <div class="mb-3 col-lg-12 p-3">
                        <label class="form-label" for="nama">Nama Kategori Arus Kas Keluar</label>
                        <input type="text" class="form-control" id="nama" name="nama" required
                            oninvalid="this.setCustomValidity('Nama Kategori Wajib Diisi!!')"
                            oninput="setCustomValidity('')">
                        @error('nama')
                            <p class="text-danger">Nama Kategori Wajib Diisi!!</p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="ms-3 btn btn-primary">Tambah</button>
                        <a href="{{ url('/sumberkeluar', []) }}" class=" btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Sumber Kas Masuk --}}
    @foreach ($sumberkeluar as $row)
        <div class="modal fade" id="UbahSumberKeluar-{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kategori Arus Kas Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container p-3">
                        <form action="{{ url('/sumberkeluar', [$row->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="nama">Nama Kategori Arus Kas Keluar</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ $row->nama }}">
                                @error('nama')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="ms-3 btn btn-primary">Edit</button>
                                <a href="{{ url('/sumberkeluar', []) }}" class=" btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection


{{-- @section('script')
    <!-- Page level plugins -->
    <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
    <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
@endsection --}}
