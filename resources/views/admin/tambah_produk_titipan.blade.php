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

            <form action="{{url('/admin/produk/titipan/add')}}" class="p-3" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-2">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" accept="image/png, image/jpeg" class="form-control" id="gambar" name="gambar" required>
                </div>
                <label for="">Penitip</label>
                <select class="form-select mb-2" aria-label="Default select example" name="id_penitip">
                    <option selected disabled>Nama penitip</option>
                    @forelse ($penitip as $item)
                    <option value="{{$item['id_penitip']}}">{{$item['nama']}}</option>
                    @empty
                    <tr>
                        <td colspan="4">No data</td>
                    </tr>
                    @endforelse
                </select>
                <div class="mb-2">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" min="0" name="stok" required>
                </div>
                <div class="mb-2">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="4" name="deskripsi" id="deskripsi"></textarea>
                </div>
                <div class="mb-2">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" min="0" name="harga" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection