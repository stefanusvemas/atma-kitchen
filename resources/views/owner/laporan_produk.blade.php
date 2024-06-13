@extends('owner/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Laporan Penjualan Bulanan per Produk</h3>

            <form action="{{url('/pdf/penjualan-produk/')}}">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <input type="month" name="month" required>
                            <br>
                            <button class="btn btn-outline-primary mt-2" type="submit">Cetak</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</main>

@endsection