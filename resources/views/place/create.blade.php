@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Create Kategori</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('list/categories') }}">Tempat</a></li>
                        <li class="breadcrumb-item fw-bold active">Tambah Tempat</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('places/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Tambah Tempat</span></h5>
                                </div>
                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Nama Tempat <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Foto (banyak foto)<span class="login-danger">*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Kategori <span class="login-danger">*</span></label>
                                        <select class="form-control select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($categories as $list)
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Jam Operasional <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('operational_hours') is-invalid @enderror" name="operational_hours">
                                        @error('operational_hours')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Deskripsi <span class="login-danger">*</span></label>
                                        <textarea id="basic-example" name="description" class="@error('description') is-invalid @enderror"></textarea>
                                        <!-- <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"> -->
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Alamat <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>URL Website <span class="login-info">(optional)</span></label>
                                        <input type="text" class="form-control @error('website') is-invalid @enderror" name="website">
                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Social Media <span class="login-info">(optional)</span></label>
                                        <input type="text" class="form-control @error('social_media') is-invalid @enderror" name="social_media">
                                        @error('social_media')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Latitude <span class="login-danger">*</span></label>
                                        <input type="text" readonly name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror">
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Longitude <span class="login-danger">*</span></label>
                                        <input type="text" readonly name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror">
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 px-2">
                                    <div id="mapContainer" style="height: 400px;"></div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="d-flex gap-4">
                                        <div class="button-cancel">
                                            <a href="{{ route('list/categories') }}" class="btn btn-danger">Batal</a>
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

@section('script')
<script>
    // Inisialisasi peta
    mapboxgl.accessToken = '{{ env("LARAVEL_APP_MAPBOX") }}';
    var map = new mapboxgl.Map({
        container: 'mapContainer', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [109.12410532246922, -6.87670482108234], // starting position [lng, lat]
        zoom: 12 // starting zoom
    });

    // Init geocoder
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker: {
            color: 'rgb(56, 32, 201, 1)',
        },
        mapboxgl: mapboxgl
    });

    // Menambahkan geocoder ke peta
    map.addControl(geocoder);

    // Init marker
    var marker = new mapboxgl.Marker({
        draggable: true,
        color: 'rgb(56, 32, 201, 1)' // Warna marker
    });

    // Event listener saat geocoder mendapatkan hasil
    geocoder.on('result', function(e) {
        var lngLat = e.result.geometry.coordinates;

        // Hapus marker sebelumnya (jika ada)
        if (marker) {
            marker.remove();
        }

        // Buat marker baru
        marker.setLngLat(lngLat).addTo(map);

        // Update inputan latitude dan longitude
        document.getElementById('latitude').value = lngLat[1];
        document.getElementById('longitude').value = lngLat[0];

        // Update inputan latitude dan longitude saat marker digeser
        marker.on('dragend', function() {
            var lngLat = marker.getLngLat();
            document.getElementById('latitude').value = lngLat.lat;
            document.getElementById('longitude').value = lngLat.lng;
        });
    });

    // Update inputan latitude dan longitude saat marker digeser (untuk marker awal)
    marker.on('dragend', function() {
        var lngLat = marker.getLngLat();
        document.getElementById('latitude').value = lngLat.lat;
        document.getElementById('longitude').value = lngLat.lng;
    });
</script>

<script src="https://cdn.tiny.cloud/1/3ituox0mhf6744v1cssbp9py7w78zb1crdziktkpadi43sfu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#basic-example',
        height: 300,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>
@endsection

@endsection