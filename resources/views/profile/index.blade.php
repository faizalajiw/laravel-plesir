@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Profile</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header mb-5">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item fw-bold active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <!-- HEADER PROFILE -->
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">
                            <div class="avatar-profile">
                                <a href="{{ $user->image }}">
                                    <img alt="Foto" src="{{ $user->image }}">
                                </a>
                            </div>
                        </div>
                        <div class="col ms-md-n2 profile-user-info">
                            <h4 class="user-name my-1">{{ $user->name }}</h4>
                            <h6 class="text-muted">{{ $user->role_name }}</h6>
                        </div>
                        <div class="col-auto profile-btn">
                            <button class="btn btn-primary" id="editButton">Edit</button>
                        </div>

                        <form action="{{ route('change/image') }}" method="POST" enctype="multipart/form-data" id="imageForm" style="display: none;">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Upload Gambar: <span class="login-danger">(.jpeg/.png/.jpg/.gif) max.2MB*</span></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelButton">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('editButton').addEventListener('click', function() {
                                var form = document.getElementById('imageForm');
                                form.style.display = 'block';
                            });

                            document.getElementById('cancelButton').addEventListener('click', function() {
                                var form = document.getElementById('imageForm');
                                form.style.display = 'none';
                            });
                        </script>

                    </div>
                </div>
                <!-- HEADER PROFILE -->

                <!-- PROFILE DETAIL -->
                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Detail Akun</h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ route('change/detail') }}" method="POST">
                                            @csrf
                                            <div class="form-group local-forms">
                                                <label>Nama <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Session::get('name') }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group local-forms">
                                                <label>Username <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Session::get('username') }}">
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group local-forms">
                                                <label>Email <span class="login-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Session::get('email') }}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <button type=" submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Ganti Password</h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ route('change/password') }}" method="POST">
                                            @csrf
                                            <div class="form-group local-forms">
                                                <label>Password Lama <span class="login-danger">*</span></label>
                                                <input type="password" class="form-control pass-old @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}">
                                                <span class="profile-views feather-eye old-toggle-password"></span>
                                                @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group local-forms">
                                                <label>Password Baru <span class="login-danger">*</span></label>
                                                <input type="password" class="form-control pass-input @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}">
                                                <span class="profile-views feather-eye toggle-password"></span>
                                                @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group local-forms">
                                                <label>Konfirmasi Password Baru <span class="login-danger">*</span></label>
                                                <input type="password" class="form-control pass-confirm @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" value="{{ old('new_confirm_password') }}">
                                                <span class="profile-views feather-eye reg-toggle-password"></span>
                                                @error('new_confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PROFILE DETAIL -->
            </div>
        </div>
    </div>
</div>
@endsection