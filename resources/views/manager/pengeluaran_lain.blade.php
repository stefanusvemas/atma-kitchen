@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Pengeluaran Lain</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('manager/pengeluaran_lain/add')}}" class="btn btn-primary">Tambah Pengeluaran Lain</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari pengeluaran lain...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Jumlah Pengeluaran</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">2024-02-12</td>
                        <td>Makan siang</td>
                        <td>200000</td>
                        <td><a href="{{url('manager/pengeluaran_lain/edit')}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td scope="row">2024-02-12</td>
                        <td>Makan siang</td>
                        <td>200000</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection