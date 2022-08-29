@extends('sb-admin/app')

@section('tittle', 'Reset Password')
@section('bg-blue', 'bg-success')

@section('body')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-md-5">

                <div class="card  o-hidden border-0 shadow-lg my-5" style="border-radius: 1.4em">
                    <div class=" card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="text-success mb-4">RESET PASSWORD</h1>
                                    </div>
                                    <form class="user " action="/reset-password" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Masukan Email" name="email" value="{{ request()->email }}">
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
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Ulangi password"
                                                name="password_confirmation">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success btn-user btn-block">
                                            Reset Password</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
