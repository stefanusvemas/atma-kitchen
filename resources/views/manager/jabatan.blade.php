@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Jabatan</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="#" class="btn btn-primary">Tambah Jabatan</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari jabatan...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama Jabatan</th>
                        <th scope="col">Jumlah Karyawan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Manager Operasional</td>
                        <td>2</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td scope="row">Admin</td>
                        <td>5</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td scope="row">Owner</td>
                        <td>1</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection