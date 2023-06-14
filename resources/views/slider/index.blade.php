@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Slider Banner</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item fw-bold active">Slider Banner</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="form-title">Slider Banner</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('sliders/create') }}" class="btn btn-primary">
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
                                        <th>Foto</th>
                                        <th>Judul</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" alt="Avatar" src="{{ $list->image }}">
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $list->title }}</td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                        @if (Session::get('role_name') === 'Super Admin')
                                        <td class="text-center">
                                            <div class="actions gap-3">
                                                <a href="{{ route('view/sliders/edit', ['id' => $list->id]) }}" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light sliders_delete" data-bs-toggle="modal" data-bs-target="#deleteSlider">
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
<div class="modal fade contentmodal" id="deleteSlider" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
            </div>
            <div class="modal-body">
                <form action="{{ route('sliders/delete') }}" method="POST">
                    @csrf
                    <div class="delete-wrap text-center">
                        <input type="hidden" name="id" class="e_id" value="">
                        <input type="hidden" name="image" class="e_image" value="">
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
    $(document).on('click', '.sliders_delete', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
        $('.e_image').val(_this.find('.image').text());
    });
</script>
@endsection

@endsection