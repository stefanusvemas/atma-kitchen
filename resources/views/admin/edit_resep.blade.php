@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/resep')}}">Resep</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Resep</h4>

            <form action="" class="p-3">
                <label for="produk">Nama produk</label>
                <select class="form-select mb-2" aria-label="Default select example">
                    <option selected disabled>Pilih produk</option>
                    <option value="1">Red Velvet</option>
                    <option value="2">Kue Coklat</option>
                    <option value="3">Kue Putih</option>
                </select>
                <label for="bahan">Bahan baku</label>
                <select class="form-select mb-2" aria-label="Default select example">
                    <option selected disabled>Pilih bahan baku</option>
                    <option value="1">Tepung Terigu</option>
                    <option value="2">Coklat</option>
                    <option value="3">Susu</option>
                </select>
                <div class="mb-2">
                    <label for="harga" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="harga" min="0">
                </div>
                <label for="bahan">Satuan</label>
                <select class="form-select mb-2" aria-label="Default select example">
                    <option selected disabled>Pilih satuan</option>
                    <option value="mg">Miligram (mg)</option>
                    <option value="g">Gram (g)</option>
                    <option value="kg">Kilogram (kg)</option>
                    <option value="ml">Mililiter (ml)</option>
                    <option value="l">Liter (l)</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection