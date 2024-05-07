@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Customer History</h3>

            <div class="row justify-content-between">
                <div class="col">

                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('/admin/customers/history/'.$id).'/search'}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari history...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Tanggal Transaksi</th>
                        <th scope="col">Total Harga</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td rowspan="{{ count($order['detail_transaksi']) }}" scope="row">{{ $order['tgl_transaksi'] }}</td>
                        <td rowspan="{{ count($order['detail_transaksi']) }}">Rp. {{ number_format($order['total_harga'],2,",",".") }}</td>
                        @foreach($order['detail_transaksi'] as $index => $detail)
                        @if($index > 0)
                    </tr>
                    <tr>
                        @endif
                        <td>{{ $detail['produk']['nama'] }}</td>
                        <td>{{ $detail['jumlah'] }}</td>
                        @endforeach
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection