@extends('layouts.web')
@section('content')
<!-- Jelajah Wisata -->
<section class="pt-5" id="jelajah">
    <div class="container">
        <!-- ATAS -->
        <div class="row">
            <!-- KANAN -->
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card shadow-sm p-4 mb-5">
                    <!-- MAPS -->
                    <div class="maps">
                        <div id="mapContainer" style="height: 500px;"></div>
                        <div id="longitude" hidden>{{ $places->longitude }}</div>
                        <div id="latitude" hidden>{{ $places->latitude }}</div>
                    </div>
                    <!-- MAPS -->
                </div>
            </div>
            <!-- KANAN -->
        </div>
        <!-- ATAS -->
    </div>
</section>
<!-- Jelajah Wisata -->

@section('script')
<!-- MAPBOX -->
<script>
    mapboxgl.accessToken = '{{ env("LARAVEL_APP_MAPBOX") }}';

    // Mendapatkan nilai longitude dan latitude dari elemen dengan ID yang sesuai
    var lng = parseFloat(document.getElementById('longitude').textContent);
    var lat = parseFloat(document.getElementById('latitude').textContent);

    const map = new mapboxgl.Map({
        container: 'mapContainer',
        style: 'mapbox://styles/mapbox/outdoors-v12',
        center: [lng, lat],
        zoom: 10
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
            instructions: true
        },
        language: 'id', // Set bahasa menjadi Indonesia
        interactive: false, // Nonaktifkan interaksi pada kontrol arah
    });

    map.on('load', function () {
        geolocate.trigger();

        geolocate.on('geolocate', function (position) {
            directions.setOrigin([position.coords.longitude, position.coords.latitude]);
        });

        directions.setDestination([lng, lat]);

        map.addControl(directions, 'top-left');
    });
</script>
<!-- MAPBOX -->
@endsection

@endsection