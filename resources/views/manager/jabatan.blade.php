@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Jabatan</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('/manager/jabatan/add')}}" class="btn btn-primary">Tambah Jabatan</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('manager/jabatan/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari jabatan...">
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
                    @forelse ($jabatan as $jabatan)
                    <tr>
                        <td scope="row">{{$jabatan['nama']}}</td>
                        <td>{{$jabatan['karyawan_count']}}</td>
                        <td><a href="{{url('manager/jabatan/edit/'.$jabatan['id_jabatan'])}}">Edit</a> | <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Jabatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong>{{$jabatan['nama']}}</strong>? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{url('manager/jabatan/delete/'.$jabatan['id_jabatan'])}}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection