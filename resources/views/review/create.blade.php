@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Nilai Tempat</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="#">Rating & Ulasan</a></li>
                        <li class="breadcrumb-item fw-bold active">Nilai Tempat</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('review/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Nilai Tempat</span></h5>
                                </div>

                                <!-- PILIH TEMPAT -->
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Nama Tempat <span class="login-danger">*</span></label>
                                        <select name="place_id" id="place_id" class="form-control select @error('place_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Tempat</option>
                                            @foreach ($places as $list)
                                            <option value="{{ $list->id }}">{{ $list->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('place_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- PILIH TEMPAT -->

                                <div class="col-12 col-sm-12">
                                    <!-- RATING -->
                                    <div style="padding-left: 5px; margin-bottom: 5px;">
                                        <label>Beri Penilaian <span class="login-danger">*</span></label>
                                        <ul class="rating">
                                            <li data-value="1"><i class="far fa-star"></i></li>
                                            <li data-value="2"><i class="far fa-star"></i></li>
                                            <li data-value="3"><i class="far fa-star"></i></li>
                                            <li data-value="4"><i class="far fa-star"></i></li>
                                            <li data-value="5"><i class="far fa-star"></i></li>
                                        </ul>
                                        <input type="hidden" name="rating" id="rating">
                                    </div>
                                    <!-- RATING -->

                                    <!-- ULASAN -->
                                    <div class="form-group local-forms">
                                        <label>Ulasan <span class="login-danger">*</span></label>
                                        <textarea name="ulasan" id="ulasan" class="form-control"></textarea>
                                    </div>
                                    <!-- ULASAN -->
                                </div>

                                <div class="col-12">
                                    <div class="d-flex gap-4">
                                        <div class="button-cancel">
                                            <!-- @if (Session::get('role_name') === 'Super Admin')
                                            <a href="{{ route('list/review') }}" class="btn btn-danger">Batal</a>
                                            @endif -->
                                            @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Pengguna')
                                            <a href="{{ route('list/my_review') }}" class="btn btn-danger">Batal</a>
                                            @endif
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

<script>
    const ratingContainer = document.querySelector('.rating');
    const ratingInput = document.getElementById('rating');
    const stars = ratingContainer.getElementsByTagName('li');

    for (let i = 0; i < stars.length; i++) {
        const star = stars[i];
        star.addEventListener('click', function() {
            const value = i + 1;
            updateRating(value);
        });
    }

    function updateRating(value) {
        for (let i = 0; i < stars.length; i++) {
            const star = stars[i];
            if (i < value) {
                star.innerHTML = '<i class="fas fa-star"></i>';
            } else {
                star.innerHTML = '<i class="far fa-star"></i>';
            }
        }
        ratingInput.value = value;
    }
</script>
@endsection