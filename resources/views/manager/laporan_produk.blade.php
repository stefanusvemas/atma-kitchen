@extends('manager/index')
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

                            <select class="form-select" id="bulan" name="month">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>

                            <button class="btn btn-outline-primary mt-2" type="submit">Cetak</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</main>

@endsection