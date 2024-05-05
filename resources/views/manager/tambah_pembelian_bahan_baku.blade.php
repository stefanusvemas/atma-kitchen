@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('manager/pembelian_bahan_baku')}}">Pembelian Bahan Baku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <h4>Tambah Penitip</h4>

            <form action="" class="p-3">
                <div class="mb-2">
                    <label for="tgl">Tanggal Pembelian</label>
                    <input type="date" class="form-control" name="tgl_pembelian" id="tgl">

                    <label for="nama" class="form-label">Bahan Baku</label>
                    <select class="form-select" name="nama" id="nama">
                        <option selected>Pilih Jabatan</option>
                        <option value="1">Tepung Terigu</option>
                        <option value="2">Gula Pasir</option>
                        <option value="3">Susu</option>
                    </select>

                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah_pembelian" id="jumlah">

                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="total_harga" id="harga">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection