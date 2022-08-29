@extends('sb-admin/app')

@section('tittle', 'Login')
@section('bg-blue', 'bg-success')

@section('body')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-md-5">

                <div class="card  o-hidden border-0 shadow-lg my-5">
                    <div class=" card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="text-success mb-4">LOGIN</h1>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form class="user " action={{ url('/login') }} method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Masukan Email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Masukan password" name="password">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block fw-bolder">
                                            Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center ">
                                        <a class="small text-decoration-none text-success"
                                            href={{ url('/forgot-password') }}>Lupa
                                            Password?</a>
                                        <br>
                                        <a class="small text-decoration-none text-success" href={{ url('/') }}>Kembali
                                            ke Halaman Depan?</a>
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
