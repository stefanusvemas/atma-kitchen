@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/bahan_baku')}}">Bahan Baku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Bahan Baku</h4>

            <form action="" class="p-3">
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama Bahan Baku</label>
                    <input type="text" class="form-control" id="nama" value="Coklat">
                </div>
                <div class="mb-2">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" min="0" value="10">
                </div>
                <div class="mb-2">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" value="20000">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>

@endsection