@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Users Management</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item fw-bold active">Admin Wisata</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="search-group-form mt-5">
            <form action="{{ route('users/search') }}" method="GET">
                <div class="row">
                    <div class="col-lg-3 ">
                        <div class="form-group">
                            <input type="text" name="users_id" class="form-control" placeholder="Search by ID ..." value="{{ request('users_id') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Search by Name ..." value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Search by Username ..." value="{{ request('username') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary text-white">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="form-title">List Admin Wisata</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('users/create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-table table-hover table-center mb-0 datatable table-striped">
                                <thead class="table-thread">
                                    <tr>
                                        <th>No</th>
                                        <th>Users ID</th>
                                        <th>Avatar</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role Name</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->users_id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" alt="Avatar" src="{{ url('storage/' . $list->avatar) }}">
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->username }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td>{{ $list->role_name }}</td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                        @if (Session::get('role_name') === 'Super Admin')
                                        <td class="text-center">
                                            <div class="actions gap-3">
                                                <a href="{{ route('view/users/edit', ['id' => $list->id]) }}" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light user_delete" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                                    <i class="feather-trash-2 me-1"></i>
                                                </a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- model user delete --}}
<div class="modal fade contentmodal" id="deleteUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
            </div>
            <div class="modal-body">
                <form action="{{ route('users/delete') }}" method="POST">
                    @csrf
                    <div class="delete-wrap text-center">
                        <input type="hidden" name="id" class="e_id" value="">
                        <h2>Hapus Data?</h2>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-success me-2">Ya</button>
                            <a class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
{{-- delete js --}}
<script>
    $(document).on('click', '.user_delete', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>
@endsection

@endsection