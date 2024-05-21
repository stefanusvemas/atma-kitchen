@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>List Pesanan</h3>



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
                        <th scope="col">Total Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $p)
                    @foreach ($p->detail_transaksi as $detail)
                    <tr>
                        <td>{{ $p->tgl_transaksi }}</td>
                        <td>{{ $detail->produk->nama }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td scope="row">{{ $detail->jumlah * $detail->produk->harga}}</td>
                        <td>
                            <a href="{{url('/orders/accept/'.$p['id_transaksi'])}}">Proses</a> |
                            <a href="{{url('/orders/reject/'.$p['id_transaksi'])}}">Tolak</a> |
                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id_orders }}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                    <!-- <div class="modal fade" id="deleteModal{{$p['id_orders']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete orders Bahan Baku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('manager/orders_bahan_baku/delete/'.$p['id_orders'])}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
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