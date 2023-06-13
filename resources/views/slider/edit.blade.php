@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Edit - Slider Banner</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('list/sliders') }}">Slider Banner</a></li>
                        <li class="breadcrumb-item fw-bold active">Edit Slider Banner</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sliders/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Edit Slider Banner</span></h5>
                                </div>
                                <input type="hidden" class="form-control" name="id" value="{{ $sliders->id }}">
                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Judul <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $sliders->title }}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Gambar <span>*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ $sliders->image }}">
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-4">
                                        <div class="button-cancel">
                                            <a href="{{ route('list/sliders') }}" class="btn btn-danger">Batal</a>
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