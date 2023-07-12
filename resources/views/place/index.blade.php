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
                        <li class="breadcrumb-item"><a href="{{ route('list/places') }}">Tempat</a></li>
                        <li class="breadcrumb-item active">Kelola Tempat</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- <div class="search-group-form mt-5">
            <form action="{{ route('places/search') }}" method="GET">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" name="category_id" class="form-control" style="font-size: 15px;" placeholder="Cari berdasarkan Kategori ..." value="{{ request('category') }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" style="font-size: 15px;" placeholder="Cari berdasarkan Nama Tempat ..." value="{{ request('title') }}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" name="user_id" class="form-control" style="font-size: 15px;" placeholder="Cari berdasarkan Pengelola ..." value="{{ request('user') }}">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary text-white">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> -->

        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="form-title">Kelola Tempat</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('places/create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Tambah
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-table table-hover table-center mb-0 datatable table-striped">
                                <thead class="table-thread">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Nama Tempat</th>
                                        <th>Pengelola</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($places as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->category->name }}</td>
                                        <td>{{ $list->title }}</td>
                                        <td>{{ $list->user->name }}</td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                        @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Admin Wisata')
                                        <td class="text-center">
                                            <div class="actions gap-3">
                                                <a href="{{ route('view/places/edit', ['id' => $list->id]) }}" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light place_delete" data-bs-toggle="modal" data-bs-target="#deletePlace">
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
<div class="modal fade contentmodal" id="deletePlace" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
            </div>
            <div class="modal-body">
                <form action="{{ route('places/delete') }}" method="POST">
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
    $(document).on('click', '.place_delete', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>
@endsection

@endsection