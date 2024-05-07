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
                    <form action="{{url('manager/pengeluaran_lain/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari pengeluaran lain...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{session('success')}}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{session('error')}}
            </div>
            @endif

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
                    @forelse ($pengeluaran_lain as $p)
                    <tr>
                        <td scope="row">{{$p['tgl_Pengeluaran']}}</td>
                        <td>{{$p['deskripsi']}}</td>
                        <td>Rp. {{number_format($p['jumlah_pengeluaran'],2,",",".")}}</td>
                        <td><a href="{{url('manager/pengeluaran_lain/edit/'.$p['id_pengeluaran'])}}">Edit</a> | <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{$p['id_pengeluaran']}}">Hapus</a></td>
                    </tr>
                    <div class="modal fade" id="deleteModal{{$p['id_pengeluaran']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Karyawan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('manager/pengeluaran_lain/delete/'.$p['id_pengeluaran'])}}" class="btn btn-danger">Delete</a>
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