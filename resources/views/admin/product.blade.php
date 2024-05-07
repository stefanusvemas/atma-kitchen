@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Produk</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tambah Produk
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{url('admin/produk/add')}}">Produk Sendiri</a></li>
                            <li><a class="dropdown-item" href="{{url('/admin/produk/titipan/add')}}">Produk Titipan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('/admin/produk/search')}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari produk..." name="search">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>
            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Kuota Produksi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                    <tr>
                        <td scope="row">{{$item['nama']}}</td>
                        <td>{{$item['stok']}}</td>
                        <td>{{$item['kuota_produksi']}}</td>
                        <td><a href="{{url('admin/produk/edit/'.$item['id_produk'])}}">Edit</a> | <a href="{{url('admin/produk/delete/'.$item['id_produk'])}}">Hapus</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection