@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<title>Edit - Tempat</title>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item fw-bold"><a href="{{ route('list/categories') }}">Tempat</a></li>
                        <li class="breadcrumb-item fw-bold active">Edit Tempat</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('places/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Edit Tempat</span></h5>
                                </div>
                                <input type="hidden" class="form-control" name="id" value="{{ $places->id }}">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Nama Tempat <span class="login-danger">*</span></label>
                                        <input type="text" name="title" value="{{ $places->title }}" class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Kategori <span class="login-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control select @error('category_id') is-invalid @enderror">
                                            <option disabled>Pilih Kategori</option>
                                            @foreach ($categories as $list)
                                            <option value="{{ $list->id }}" {{ $places->category_id == $list->id ? 'selected' : '' }}>
                                                {{ $list->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Foto (banyak foto)<span class="login-danger">*</span></label>
                                        <input type="file" name="image[]" multiple class="form-control @error('image.*') is-invalid @enderror @error('image') is-invalid @enderror">
                                        @error('image.*')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        @if ($places->images->count() > 0)
                                        <div class="container mt-4">
                                            <div class="mb-2">Foto - foto sebelumnya:</div>
                                            <div class="row">
                                                @foreach ($places->images as $image)
                                                <div class="col-sm-3">
                                                    <div class="image-content">
                                                        <img src="{{ $image->image }}" alt="Place Image">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group local-forms">
                                        <label>Hari Operasional<span class="login-danger">*</span></label>
                                        <!-- <input type="text" name="day" value="{{ $places->day }}" class="form-control @error('day') is-invalid @enderror"> -->
                                        <select name="day[]" class="form-control select @error('day') is-invalid @enderror" multiple>
                                            <option value="Senin" {{ (is_array($places->day) && in_array('Senin', $places->day)) ? 'selected' : '' }}>Senin</option>
                                            <option value="Selasa" {{ (is_array($places->day) && in_array('Selasa', $places->day)) ? 'selected' : '' }}>Selasa</option>
                                            <option value="Rabu" {{ (is_array($places->day) && in_array('Rabu', $places->day)) ? 'selected' : '' }}>Rabu</option>
                                            <option value="Kamis" {{ (is_array($places->day) && in_array('Kamis', $places->day)) ? 'selected' : '' }}>Kamis</option>
                                            <option value="Jumat" {{ (is_array($places->day) && in_array('Jumat', $places->day)) ? 'selected' : '' }}>Jumat</option>
                                            <option value="Sabtu" {{ (is_array($places->day) && in_array('Sabtu', $places->day)) ? 'selected' : '' }}>Sabtu</option>
                                            <option value="Minggu" {{ (is_array($places->day) && in_array('Minggu', $places->day)) ? 'selected' : '' }}>Minggu</option>
                                        </select>
                                        @error('day')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Jam Buka <span class="login-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="time" name="hours_start" value="{{ $places->hours_start }}" class="form-control @error('hours_start') is-invalid @enderror" min="00:00" max="23:59">
                                        </div>
                                        @error('hours_start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="form-group local-forms">
                                        <label>Jam Tutup <span class="login-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="time" name="hours_end" value="{{ $places->hours_end }}" class="form-control @error('hours_end') is-invalid @enderror" min="00:00" max="23:59">
                                        </div>
                                        @error('hours_end')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group local-forms">
                                        <label>Deskripsi <span class="login-danger">*</span></label>
                                        <textarea id="basic-example" name="description" class="@error('description') is-invalid @enderror">{{ $places->description }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Alamat <span class="login-danger">*</span></label>
                                        <input type="text" name="address" value="{{ $places->address }}" class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Harga Tiket Masuk<span class="login-danger">*</span></label>
                                        <input type="text" name="price" value="{{ $places->price }}" class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Instagram <span class="login-info">(optional)</span></label>
                                        <input type="text" name="social_media" value="{{ $places->social_media }}" class="form-control @error('social_media') is-invalid @enderror">
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
                                        <input type="text" readonly name="latitude" value="{{ $places->latitude }}" id="latitude" class="form-control @error('latitude') is-invalid @enderror">
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
                                        <input type="text" readonly name="longitude" value="{{ $places->longitude }}" id="longitude" class="form-control @error('longitude') is-invalid @enderror">
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
                                            @if (Session::get('role_name') === 'Super Admin')
                                            <a href="{{ route('list/places') }}" class="btn btn-danger">Batal</a>
                                            @endif
                                            @if (Session::get('role_name') === 'Admin Wisata')
                                            <a href="{{ route('list/my_places') }}" class="btn btn-danger">Batal</a>
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

@section('script')
<!-- MAPBOX -->
<script>
    // Inisialisasi peta
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFpemFsYWppdyIsImEiOiJjbGUyYmczYWgwN3JqM3BtanB5NDZqY2xiIn0.jWcan3Z7z2mxRfrLkkjaJQ';

    // Batas Kota Tegal
    const kotaTegalBounds = [
        [109.1080, -6.9000], // Sudut barat daya
        [109.1500, -6.8697] // Sudut timur laut
    ];

    // Batas Kabupaten Tegal
    const kabupatenTegalBounds = [
        [109.2193, -7.2336], // Sudut barat daya
        [109.3600, -6.5850] // Sudut timur laut
    ];

    // Menggabungkan batas Kota Tegal dan Kabupaten Tegal
    const combinedBounds = [
        [Math.min(kotaTegalBounds[0][0], kabupatenTegalBounds[0][0]), Math.min(kotaTegalBounds[0][1], kabupatenTegalBounds[0][1])],
        [Math.max(kotaTegalBounds[1][0], kabupatenTegalBounds[1][0]), Math.max(kotaTegalBounds[1][1], kabupatenTegalBounds[1][1])]
    ];

    var map = new mapboxgl.Map({
        container: 'mapContainer', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [109.12410532246922, -6.87670482108234], // starting position [lng, lat]
        maxBounds: combinedBounds,
        zoom: 10 // starting zoom
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

    // Tambahkan GeolocateControl untuk deteksi lokasi pengguna
    var geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
    });

    map.addControl(geolocate);

    // Event listener saat lokasi pengguna ditemukan
    geolocate.on('geolocate', function(e) {
        var lngLat = [e.coords.longitude, e.coords.latitude];

        // Hapus marker sebelumnya (jika ada)
        if (marker) {
            marker.remove();
        }

        // Buat marker baru
        marker.setLngLat(lngLat).addTo(map);

        // Update inputan latitude dan longitude
        document.getElementById('latitude').value = lngLat[1];
        document.getElementById('longitude').value = lngLat[0];
    });
</script>
<!-- MAPBOX -->

<!-- TINY JS -->
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
<!-- TINY JS -->
@endsection

@endsection