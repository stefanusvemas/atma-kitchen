@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Dashboard</h3>
            <hr>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Today's Orders</h6>
                            <h5 class="card-text">{{$today_order}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Today's Income</h6>
                            <h5 class="card-text">Rp. {{$today_income}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                <div class="col">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Today's Tips</h6>
            <h5 class="card-text">Rp. {{ number_format(session('today_tips', 0), 2, ',', '.') }}</h5>
        </div>
    </div>
</div>
            </div>
            <h4 class="mt-3">Recent Transactions</h4>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Customer's name</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="w-50">Item</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recent_transaction as $items => $transactions)
                    @foreach ($transactions as $index => $transaction)
                    <tr>
                        @if ($index === 0)
                        <td rowspan="{{ count($transactions) }}">{{ $transaction['transaksi']['customer']['nama'] }}</td>
                        @endif
                        <td>{{ $transaction['transaksi']['tgl_transaksi'] }}</td>
                        <td>{{ $transaction['produk']['nama'] }}</td>
                    </tr>
                    @endforeach
                    @empty
                    <tr>
                        <td colspan="3">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection