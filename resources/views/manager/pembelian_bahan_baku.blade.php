@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Pembelian Bahan Baku</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('manager/pembelian_bahan_baku/add')}}" class="btn btn-primary">Tambah Pembelian Bahan Baku</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari bahan baku...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Tanggal</th>
                        <th scope="col">Nama Bahan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-02-12</td>
                        <td scope="row">Tepung Terigu</td>
                        <td>20</td>
                        <td>120000</td>
                        <td><a href="{{url('manager/pembelian_bahan_baku/edit')}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td>2024-02-12</td>
                        <td scope="row">Gula Pasir</td>
                        <td>20</td>
                        <td>30000</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td>2024-02-12</td>
                        <td scope="row">Garam</td>
                        <td>20</td>
                        <td>120000</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection