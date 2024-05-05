@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Bahan Baku</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('admin/bahan_baku/add')}}" class="btn btn-primary">Tambah Bahan</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('admin/bahan_baku/search')}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari bahan...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-75">Nama</th>
                        <th>Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bahan_baku as $item)
                    <tr>
                        <td scope="row">{{$item['nama']}}</td>
                        <td>{{$item['harga']}}</td>
                        <td>{{$item['stok']}}</td>
                        <td><a href="{{url('admin/bahan_baku/edit/'.$item['id_bahan_baku'])}}">Edit</a> | <a href="{{url('admin/bahan_baku/delete/'.$item['id_bahan_baku'])}}">Hapus</a></td>
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