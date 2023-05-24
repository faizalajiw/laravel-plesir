@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">My Account</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- HEADER PROFILE -->
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">
                            <div class="avatar-profile">
                                <a href="{{ url('storage/' . Session::get('avatar')) }}">
                                    <img alt="{{ Session::get('name') }}" src="{{ url('storage/' . Session::get('avatar')) }}">
                                </a>
                            </div>
                        </div>
                        <div class="col ms-md-n2 profile-user-info">
                            <h4 class="user-name my-1">{{ Session::get('name') }}</h4>
                            <h6 class="text-muted">{{ Session::get('role_name') }}</h6>
                        </div>
                        <div class="col-auto profile-btn">
                            <button class="btn btn-primary" id="editButton">Edit</button>
                        </div>

                        <form action="{{ route('change/avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm" style="display: none;">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Pilih Foto:</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cancelButton">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('editButton').addEventListener('click', function() {
                                var form = document.getElementById('avatarForm');
                                form.style.display = 'block';
                            });

                            document.getElementById('cancelButton').addEventListener('click', function() {
                                var form = document.getElementById('avatarForm');
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
                                <h5 class="card-title">Detail Akun</h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ route('change/email') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Session::get('name') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Session::get('email') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <input type="text" class="form-control text-muted @error('email') is-invalid @enderror" name="role_name" readonly value="{{ Session::get('role_name') }}"">
                                            </div>
                                                <button type=" submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ganti Password</h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ route('change/password') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Password Lama</label>
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}">
                                                @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Password Baru</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}">
                                                @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Konfirmasi Password Baru</label>
                                                <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" value="{{ old('new_confirm_password') }}">
                                                @error('new_confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Account Status</span>
                                        <a class="edit-link" href="#"><i class="far fa-edit me-1"></i>Edit</a>
                                    </h5>
                                    <button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> Active</button>
                                </div>
                            </div>
                    </div> -->
                </div>
                <!-- PROFILE DETAIL -->
            </div>
        </div>
    </div>
</div>
@endsection