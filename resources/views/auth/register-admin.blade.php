@extends('layouts.app')
@section('content')
{!! Toastr::message() !!}
<title>Register</title>
<div class="login-right">
    <div class="login-right-wrap">
        <h1 class="form-title">
            <img src="{{ asset('assets/img/plesir.png') }}" alt="Logo Plesir">
        </h1>

        <form action="{{ route('register-admin.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama <span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
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
                <label>Email <span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input  @error('password') is-invalid @enderror" name="password">
                <span class="profile-views feather-eye toggle-password"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-confirm @error('confirm_password') is-invalid @enderror" name="confirm_password">
                <span class="profile-views feather-eye reg-toggle-password"></span>
                @error('confirm_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="forgotpass">
                <div class="subtitle-left">Sudah Punya Akun?
                    <a href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Gabung</button>
            </div>
        </form>
    </div>
</div>
@endsection