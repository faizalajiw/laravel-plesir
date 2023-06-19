@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Tambah Jumlah Pengunjung</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('list/history') }}">Data Pengunjung</a></li>
                        <li class="breadcrumb-item fw-bold active">Tambah Jumlah</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('visitor/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Tambah Jumlah Pengunjung</span></h5>
                                </div>
                                <input type="hidden" class="form-control" name="id" value="{{ $visitor->id }}">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Nama Tempat <span class="login-danger">*</span></label>
                                        <select name="place_id" id="place_id" class="form-control select @error('place_id') is-invalid @enderror">
                                            <option disabled>Pilih Tempat</option>
                                            @foreach ($places as $list)
                                            <option value="{{ $list->id }}" {{ $visitor->place->id == $list->id ? 'selected' : '' }}>
                                                {{ $list->title }}
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('place_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Senin <span class="login-danger">*</span></label>
                                        <input type="number" name="senin" class="form-control @error('address') is-invalid @enderror">
                                        @error('senin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Selasa <span class="login-danger">*</span></label>
                                        <input type="number" name="selasa" class="form-control @error('address') is-invalid @enderror">
                                        @error('selasa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Rabu <span class="login-danger">*</span></label>
                                        <input type="number" name="rabu" class="form-control @error('address') is-invalid @enderror">
                                        @error('rabu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Kamis <span class="login-danger">*</span></label>
                                        <input type="number" name="kamis" class="form-control @error('address') is-invalid @enderror">
                                        @error('kamis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Jumat <span class="login-danger">*</span></label>
                                        <input type="number" name="jumat" class="form-control @error('address') is-invalid @enderror">
                                        @error('jumat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Sabtu <span class="login-danger">*</span></label>
                                        <input type="number" name="sabtu" class="form-control @error('address') is-invalid @enderror">
                                        @error('sabtu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Minggu <span class="login-danger">*</span></label>
                                        <input type="number" name="minggu" class="form-control @error('address') is-invalid @enderror">
                                        @error('minggu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <h6 class="text-primary">*Note: <span>Masukkan jumlah pengunjung baru. Data akan otomatis ditambahkan dengan jumlah pengunjung sebelumnya</span></h6>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="d-flex gap-4">
                                        <div class="button-cancel">
                                            <a href="{{ route('list/history') }}" class="btn btn-danger">Batal</a>
                                        </div>
                                        <div class="button-submit">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
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