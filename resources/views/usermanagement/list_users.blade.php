
@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All List</li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">All List</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="add-time-table.html" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>Id</th>
                                        <th>Avatar</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $list)
                                    <tr>
                                        <td class="user_id">{{ $list->user_id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" alt="Avatar" src="{{ url('storage/' . $list->avatar) }}">
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td>{{ $list->role_name }}</td>
                                        @if (Session::get('role_name') === 'Super Admin')
                                        <td class="text-center">
                                            <div class="actions">
                                                <a href="{{ route('view/user/edit', ['id' => $list->user_id]) }}"class="btn btn-sm bg-danger-light">
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
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                    class="feather-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user/delete') }}" method="POST">
                    @csrf
                    <div class="delete-wrap text-center">
                        <div class="del-icon">
                            <i class="feather-x-circle"></i>
                        </div>
                        <!-- <input type="hidden" name="user_id" class="e_user_id" value="">
                        <input type="hidden" name="avatar" class="e_avatar" value=""> -->
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
    $(document).on('click','.user_delete',function()
    {
        var _this = $(this).parents('tr');
        $('.e_user_id').val(_this.find('.user_id').text());
        $('.e_avatar').val(_this.find('.avatar').text());
    });
</script>
@endsection

@endsection
