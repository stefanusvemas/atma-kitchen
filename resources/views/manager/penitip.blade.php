@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Penitip</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('manager/penitip/add')}}" class="btn btn-primary">Tambah Penitip</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari penitip...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">John Kerupuk</td>
                        <td>Jl. Merdeka Barat No. 01</td>
                        <td>08131312222</td>
                        <td><a href="{{url('manager/penitip/edit')}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td scope="row">Justin Jamu</td>
                        <td>Jl. Merdeka Barat No. 01</td>
                        <td>08131312222</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    <tr>
                        <td scope="row">Henry Dodol</td>
                        <td>Jl. Merdeka Barat No. 01</td>
                        <td>08131312222</td>
                        <td><a href="#">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection