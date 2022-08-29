@extends('sb-admin/app')

@section('tittle', 'Profil Yayasan')
@section('profilyayasan', 'active')
@section('content')

    <!-- Page Heading -->
    <div class="container">
        <h1 class="h3 mb-0 text-gray-800 pb-5">Profil Yayasan</h1>
        {{-- <a role="button" data-bs-toggle="modal" data-bs-target="#TambahProfilYayasan" class="btn btn-primary mt-5 mb-3 ms-3"><i
                class="fa-solid fa-plus"></i> Tambah
            Dokumentasi
        </a> --}}
        @foreach ($profil as $row)
            <div class="card mb-3 shadow">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ($row->fotoprofil)
                            <img src="upload/fotoprofil/{{ $row->fotoprofil }}" class="card-img-top" height="310px"
                                alt="...">
                        @else
                            <img src="/a.jpg" class="card-img-top" height="310px" alt="...">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body fs-5">
                            <p class="p-3 text-center">
                                {{ $row->profily }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-center pt">
                <p>
                    Apakah anda ingin merubah profil Yayasan?
                </p>
                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahProfilYayasan-{{ $row->id }}"
                    class="text-decoration-none text-success"><span> Ubah Profil Yayasan</span></a>
            </div>
        @endforeach



        {{-- <div class="modal fade" id="TambahProfilYayasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Profil Yayasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <small class="text-danger ms-3 fst-italic">* Wajib Diisi</small>
                    </div>
                    <div class="container p-3">
                        <form action="/profily" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 col-lg-12">
                                <label for="fotoprofil" class="form-label">Upload Gambar <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="fotoprofil" name="fotoprofil">
                                @error('fotoprofil')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="profily">Masukan Deskripsi Profil Yayasan</label>
                                <textarea type="text" class="form-control" id="profily" name="profily" value="{{ old('profily') }}" required></textarea>
                                @error('profily')
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
        </div> --}}

        @foreach ($profil as $row)
            {{-- Edit Arus Kas Masuk --}}
            <div class="modal fade" id="UbahProfilYayasan-{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Profil Yayasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="container p-3">
                            <div class="card mb-3 p-3" style="max-width: 800px; border-radius: 1em">
                                <div class="row g-0">
                                    <form action="/profily/{{ $row->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3 col-lg-12">
                                            <label for="fotoprofil" class="form-label">Upload Gambar <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="file" id="fotoprofil" name="fotoprofil">
                                            @error('fotoprofil')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-lg-12">
                                            <label class="form-label" for="profily">Masukan Deskripsi Profil
                                                Yayasan</label>
                                            <input type="text" class="form-control" id="profily" name="profily"
                                                value="{{ $row->profily }}" required>
                                            @error('profily')
                                                <small class="text-danger">Keterangan Wajib Diisi!!</small>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="ms-3 btn btn-primary">Ubah</button>
                                            <a href="/profily" class=" btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="modal fade" id="ShowImg-{{ $dok->id }}" tabindex="-1" role="dialog"
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
        </div> --}}
        @endforeach


    @endsection

    @section('script')
        <!-- Page level plugins -->
        <script src="/sb-admin/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/sb-admin/js/demo/chart-area-demo.js"></script>
        <script src="/sb-admin/js/demo/chart-pie-demo.js"></script>
    @endsection
