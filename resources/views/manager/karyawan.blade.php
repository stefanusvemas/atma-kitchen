@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Karyawan</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('/manager/karyawan/add')}}" class="btn btn-primary">Tambah Karyawan</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('/manager/karyawan/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari karyawan...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Tanggal Bergabung</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawan as $karyawan)
                    <tr>
                        <td scope="row">{{$karyawan['nama']}}</td>
                        <td>{{$karyawan['jabatan']['nama']}}</td>
                        <td>{{$karyawan['tgl_bergabung']}}</td>
                        <td><a href="{{url('/manager/karyawan/edit/'.$karyawan['id_karyawan'])}}">Edit</a> | <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{$karyawan['id_karyawan']}}">Hapus</a></td>
                    </tr>
                    <div class="modal fade" id="deleteModal{{$karyawan['id_karyawan']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Karyawan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{$karyawan['nama']}}</strong>? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('manager/karyawan/delete/'.$karyawan['id_karyawan'])}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>

@endsection