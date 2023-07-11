@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Data Pengunjung</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('list/history') }}">Data Pengunjung</a></li>
                        <li class="breadcrumb-item active">Kelola Pengunjung</li>
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
                                    <h3 class="form-title">Kelola Pengunjung</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('visitor/create') }}" class="btn btn-primary">
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
                                        <th>Nama Tempat</th>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jumat</th>
                                        <th>Sabtu</th>
                                        <th>Minggu</th>
                                        <th>Total</th>
                                        <th style="color: transparent; background-color: #F8F9FA;"></th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitor as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->place->title }}</td>
                                        <td id="senin">{{ $list->senin }}</td>
                                        <td id="selasa">{{ $list->selasa }}</td>
                                        <td id="rabu">{{ $list->rabu }}</td>
                                        <td id="kamis">{{ $list->kamis }}</td>
                                        <td id="jumat">{{ $list->jumat }}</td>
                                        <td id="sabtu">{{ $list->sabtu }}</td>
                                        <td id="minggu">{{ $list->minggu }}</td>
                                        <td>{{ $list->total_hari }}</td>
                                        <td class="id" style="color: transparent; background-color: transparent;">{{ $list->id }}</td>
                                        @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Admin Wisata')
                                        <td class="text-center">
                                            <div class="actions gap-3">
                                                <a href="{{ route('view/visitor/edit', ['id' => $list->id]) }}" class="btn btn-sm bg-danger-light">
                                                    <i class="feather-plus-circle"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light visitor_delete" data-bs-toggle="modal" data-bs-target="#deleteVisitor">
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
<div class="modal fade contentmodal" id="deleteVisitor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content doctor-profile">
            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
            </div>
            <div class="modal-body">
                <form action="{{ route('visitor/delete') }}" method="POST">
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
    $(document).on('click', '.visitor_delete', function() {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>
@endsection

@endsection