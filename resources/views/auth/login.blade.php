@extends('layouts.app')
@section('content')
{!! Toastr::message() !!}
<title>Login</title>
<div class="login-right">
    <div class="login-right-wrap">
        <h1 class="form-title">
            <img src="{{ asset('assets/img/plesir.png') }}" alt="Logo Plesir">
        </h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username <span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username">
                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password">
                <span class="profile-views feather-eye toggle-password"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="forgotpass">
                <div class="subtitle-left">Belum punya akun?
                    <a href="{{ route('register') }}">Register</a>
                </div>
                <a class="subtitle-right" href="{{ route('password.request') }}">Lupa Password?</a>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Login</button>
            </div>
        </form>
        <!-- <div class="login-or">
            <span class="or-line"></span>
            <span class="span-or">or</span>
        </div> -->
    </div>
</div>

@endsection