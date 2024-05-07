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
                    <form action="{{url('manager/pembelian_bahan_baku/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari bahan baku...">
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
                        <th scope="col" class="w-50">Tanggal</th>
                        <th scope="col">Nama Bahan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembelian as $p)
                    <tr>
                        <td>{{$p['tgl_pembelian']}}</td>
                        <td scope="row">{{$p['bahan_baku']['nama']}}</td>
                        <td>{{$p['jumlah_pembelian']}}</td>
                        <td>{{$p['total_harga']}}</td>
                        <td><a href="{{url('manager/pembelian_bahan_baku/edit/'.$p['id_pembelian'])}}">Edit</a> | <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{$p['id_pembelian']}}">Hapus</a></td>
                    </tr>
                    <div class="modal fade" id="deleteModal{{$p['id_pembelian']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Pembelian Bahan Baku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('manager/pembelian_bahan_baku/delete/'.$p['id_pembelian'])}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection