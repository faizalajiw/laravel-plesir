@extends('layouts.web')
@section('content')
<!-- Jelajah Wisata -->
<section class="pt-5" id="jelajah">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card shadow-sm p-2 mb-5" style="background-color: #1A3154;">
                    <div style="font-size: 20px; color: #FFFFFF; margin-top: 15px; margin-left: 5px;"><i class="fas fa-location-arrow me-2"></i> Rute Lokasi {{ $places->title }}</div>
                    <hr>
                    <!-- MAPS -->
                    <div class="maps">
                        <div id="mapContainer" style="height: 700px;"></div>
                        <div id="longitude" hidden>{{ $places->longitude }}</div>
                        <div id="latitude" hidden>{{ $places->latitude }}</div>
                    </div>
                    <!-- MAPS -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Jelajah Wisata -->

@section('script')
<!-- MAPBOX -->
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFpemFsYWppdyIsImEiOiJjbGUyYmczYWgwN3JqM3BtanB5NDZqY2xiIn0.jWcan3Z7z2mxRfrLkkjaJQ';

    // Mendapatkan nilai longitude dan latitude dari elemen dengan ID yang sesuai
    var lng = parseFloat(document.getElementById('longitude').textContent);
    var lat = parseFloat(document.getElementById('latitude').textContent);

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

    const map = new mapboxgl.Map({
        container: 'mapContainer',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        center: [lng, lat],
        maxBounds: combinedBounds, // Set batas maksimum tampilan pada wilayah Kota Tegal dan Kabupaten Tegal
        zoom: 5
    });

    const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true
    });

    map.addControl(geolocate);

    // Inisialisasi objek Directions
    const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        profile: 'mapbox/driving-traffic',
        controls: {
            inputs: false,
            instructions: true,
        },
        language: 'id', // Set bahasa menjadi Indonesia
        interactive: false, // Nonaktifkan interaksi pada kontrol arah
    });

    map.on('load', function() {
        geolocate.trigger();

        geolocate.on('geolocate', function(position) {
            directions.setOrigin([position.coords.longitude, position.coords.latitude]);
        });

        directions.setDestination([lng, lat]);

        map.addControl(directions, 'top-left');
    });
</script>
<!-- MAPBOX -->
@endsection

@endsection