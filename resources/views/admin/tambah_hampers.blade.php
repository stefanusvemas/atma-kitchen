@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/hampers')}}">Hampers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <h4>Tambah Hampers</h4>

            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')->first()}}
            </div>
            @endif

            <form action="{{url('/admin/hampers/add')}}" method="post" enctype="multipart/form-data" class="p-3">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama Hampers</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-2">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" accept="image/png, image/jpeg" class="form-control" id="gambar" name="foto_hampers" required>
                </div>
                <div class="mb-2">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                </div>
                <div class="mb-2">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <hr>
                <h5>Produk</h5>
                <div class="mb-4" id="produk-container">
                    <div class="produk-input mb-2">
                        <label for="produk" class="form-label">Nama Produk</label>
                        <select class="form-select" name="produk[]">
                            @foreach($produk as $p)
                            <option value="{{$p->id_produk}}">{{$p->nama}}</option>
                            @endforeach
                        </select>
                        <label for="jumlah" class="mt-2">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah">
                    </div>
                </div>

                <hr class="mb-4">
                <div class="row justify-content-between">
                    <div class="col">
                        <button type="button" class="btn btn-secondary" id="add-product">Tambah Produk</button>

                    </div>
                    <div class="col col-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </div>


            </form>
        </div>
    </div>
</main>

<script>
    let productCounter = 0;

    document.getElementById("add-product").addEventListener("click", function() {
        const container = document.getElementById("produk-container");
        const div = document.createElement("div");
        div.className = "produk-input mb-2";
        const uniqueId = "product-" + productCounter;
        div.innerHTML = '<hr> <label for="' + uniqueId + '" class="form-label">Nama Produk</label><select class="form-select" id="' + uniqueId + '" name="produk[]">@foreach($produk as $p)<option value="{{$p->id_produk}}">{{$p->nama}}</option>@endforeach</select><label for="jumlah" class="mt-2">Jumlah</label><input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah">';
        container.appendChild(div);
        productCounter++;
    });
</script>





@endsection