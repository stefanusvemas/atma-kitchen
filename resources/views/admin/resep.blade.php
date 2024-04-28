@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Resep</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('admin/resep/add')}}" class="btn btn-primary">Tambah Resep</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari resep...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>

            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col" class="w-75">Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">Red Velvet</td>
                        <td>Tepung Terigu</td>
                        <td>50g</td>
                        <td><a href="{{url('admin/resep/edit')}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td>Gula Pasir</td>
                        <td>10g</td>
                        <td><a href="{{url('admin/resep/edit')}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td rowspan="1">Kue Coklat</td>
                        <td>Tepung Terigu</td>
                        <td>40g</td>
                        <td><a href="{{url('admin/resep/edit')}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection