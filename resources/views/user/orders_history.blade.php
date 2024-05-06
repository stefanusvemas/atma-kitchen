@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Orders History</h4>
            <div class="row justify-content-between">
                <div class="col"></div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('user/orders_history/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari produk...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Total Price</th>
                        <th scope="col" class="w-50">Products</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td rowspan="{{ count($order['detail_transaksi']) }}" scope="row">{{ $order['tgl_transaksi'] }}</td>
                        <td rowspan="{{ count($order['detail_transaksi']) }}">{{ number_format($order['total_harga'],2,",",".") }}</td>
                        @foreach($order['detail_transaksi'] as $index => $detail)
                        @if($index > 0)
                    </tr>
                    <tr>
                        @endif
                        <td>{{ $detail['produk']['nama'] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection