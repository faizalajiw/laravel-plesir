@extends('layouts.web')
@section('content')
<title>Pesan Tiket</title>
<!-- TIKET -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-8">
            @if (auth()->check())
            @if (auth()->user()->role_name === 'Pengguna')
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center fw-bold" style="font-size: 20px; color: #1A3154;">Pesan Tiket</div>
                    <form action="checkout/{id}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="name" name="name" value="{{ auth()->user()->name }}">
                        <div class="form-group mb-2">
                            <label for="title">Nama Tempat</label>
                            <select name="place_id" id="place_id" class="form-control select">
                                <option selected disabled>Pilih Tempat</option>
                                @foreach ($places as $list)
                                <option value="{{ $list->id }}" data-price="{{ $list->price }}" data-title="{{ $list->title }}">{{ $list->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Input tersembunyi untuk menyimpan nilai title -->
                        <input type="hidden" id="place_title" name="place_title">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="form-group mb-2">
                            <label for="tanggal">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required min="{{ date('Y-m-d') }}" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="total">Harga</label>
                            <input readonly type="number" class="form-control" id="price" name="price" required />
                        </div>
                        <div class="form-group">
                            <label for="quantity">Jumlah Tiket</label><br>
                            <input type="number" id="quantity" name="quantity" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="total">Total Harga</label>
                            <input readonly type="number" class="form-control" id="total" name="total" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block mt-4" style="font-size: 16px">
                                Pesan Tiket
                            </button>
                        </div>
                    </form>
                    @endif
                    @else
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary my- py-2">
                            <div class="my-2">Masuk Untuk Pesan Tiket</div>
                        </a>
                    </div>
                    @endif

                    <script>
                        const titleSelect = document.getElementById('place_id');
                        const priceIn = document.getElementById('price');
                        const placeTitleInput = document.getElementById('place_title');

                        titleSelect.addEventListener('change', function() {
                            const selectedOption = titleSelect.options[titleSelect.selectedIndex];
                            const selectedPrice = selectedOption.getAttribute('data-price');
                            const selectedTitle = selectedOption.getAttribute('data-title');

                            priceIn.value = selectedPrice;
                            placeTitleInput.value = selectedTitle;
                        });
                    </script>

                    <script>
                        // Ambil elemen-elemen input dan output
                        const priceInput = document.getElementById('price');
                        const quantityInput = document.getElementById('quantity');
                        const totalOutput = document.getElementById('total');

                        // Fungsi untuk menghitung total harga
                        function calculateTotal() {
                            const price = parseFloat(priceInput.value);
                            const quantity = parseInt(quantityInput.value);
                            const total = price * quantity;

                            // Tampilkan hasil perhitungan pada elemen output
                            totalOutput.value = isNaN(total) ? '' : total.toFixed(0);
                        }

                        // Panggil fungsi calculateTotal saat input berubah
                        quantityInput.addEventListener('input', calculateTotal);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TIKET -->

@endsection