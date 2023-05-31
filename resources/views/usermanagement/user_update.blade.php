@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('list/users') }}">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Edit User</span></h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nama <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ $users->name }}">
                                        <input type="hidden" class="form-control" name="id" value="{{ $users->id }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{ $users->email }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Password <span class="login-danger">*</span></label>
                                        <input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Username <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="username" value="{{ $users->username }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Role <span class="login-danger">*</span></label>
                                        <select class="form-control select @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                                            <option selected disabled>Role</option>
                                            @foreach ($role as $name)
                                            <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Avatar <span class="login-danger">*</span></label>
                                        <input type="file" class="form-control" name="avatar" value="{{ $users->avatar }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection