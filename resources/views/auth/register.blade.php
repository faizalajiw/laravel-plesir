@extends('layouts.app')
@section('content')
<div class="login-right">
    <div class="login-right-wrap">
        <h1 class="form-title">
            <img src="{{ asset('assets/img/plesir.png') }}" alt="Logo Plesir">
        </h1>
        
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama <span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
            </div>
            <div class="form-group">
                <label>Username <span class="login-danger">*</span></label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username">
                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
            </div>
            <div class="form-group">
                <label>Email <span class="login-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
            </div>
            <div class="form-group">
                <label>Password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-input  @error('password') is-invalid @enderror" name="password">
                <span class="profile-views feather-eye toggle-password"></span>
            </div>
            <div class="form-group">
                <label>Confirm password <span class="login-danger">*</span></label>
                <input type="password" class="form-control pass-confirm @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                <span class="profile-views feather-eye reg-toggle-password"></span>
            </div>
            <div class="forgotpass">
                <div class="subtitle-left">Sudah Punya Akun?
                    <a href="{{ route('login') }}">Login</a>
                </div>
                <!-- <a class="subtitle-right" href="{{ route('password.request') }}">Lupa Password?</a> -->
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection