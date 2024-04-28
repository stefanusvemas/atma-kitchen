@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/produk')}}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <h4>Tambah Produk Titipan</h4>

            <form action="" class="p-3">
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama">
                </div>
                <div class="mb-2">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" accept="image/png, image/jpeg" class="form-control" id="gambar">
                </div>
                <label for="">Penitip</label>
                <select class="form-select mb-2" aria-label="Default select example">
                    <option selected disabled>Nama penitip</option>
                    <option value="1">UMKM</option>
                    <option value="2">Nama Perusahaan</option>
                    <option value="3">Nama Usaha</option>
                </select>
                <div class="mb-2">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" min="0">
                </div>
                <div class="mb-2">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" min="0">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection