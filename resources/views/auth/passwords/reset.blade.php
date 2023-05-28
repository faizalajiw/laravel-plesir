@extends('layouts.app')
@section('content')
<div class="login-right">
    <div class="login-right-wrap">
        <h1>Reset Password</h1>
        <p class="forgot-password-subtitle">Silahkan isi password baru</p>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label>Email<span class="login-danger">*</span></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                <span class="profile-views"><i class="fas fa-envelope"></i></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password Baru<span class="login-danger">*</span></label>
                <input id="password" type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="profile-views feather-eye toggle-password"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password Baru<span class="login-danger">*</span></label>
                <input id="password-confirm" type="password" class="form-control pass-confirm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                <span class="profile-views feather-eye reg-toggle-password"></span>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection