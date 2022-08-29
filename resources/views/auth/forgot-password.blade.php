@extends('sb-admin/app')

@section('tittle', 'Lupa Password')
@section('bg-blue', 'bg-success')

@section('body')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-4">

            <div class="col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="text-success mb-4">LUPA PASSWORD?</h1>
                                        <p class="mb-4">Masukkan alamat
                                            email Anda di bawah ini dan kami akan mengirimkan tautan untuk mengatur ulang
                                            kata sandi Anda!</p>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form class="user" action="/forgot-password" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Masukan email...">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block">
                                            Kirim Email
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-decoration-none text-success" href="/login">Kemabali Ke
                                            Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
