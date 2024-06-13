@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Processing Orders</h3>
            <hr>

            <h4 class="mt-3">Orders Being Processed</h4>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Customer's Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date</th>
                        <th scope="col">Item</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Distance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($processing_orders as $order)
                        @foreach ($order->detail_transaksi as $detail)
                            @php
                                $address = $order->customer->addresses->first();
                            @endphp
                            <tr>
                                @if ($loop->first)
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $order->customer->nama }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">
                                        {{ $address->nama_jalan }}<br>
                                        {{ $address->kecamatan }}<br>
                                        {{ $address->kelurahan }}<br>
                                    </td>
                                @endif
                                <td>{{ $order->tgl_transaksi }}</td>
                                <td>{{ $detail->produk->nama }}</td>
                                @if ($loop->first)
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ number_format($order->total_harga, 2, ',', '.') }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $address->jarak }} km</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $order->status }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">
                                        <form action="{{ route('admin.updateStatus', $order->id_transaksi) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="status" value="siap dipickup" class="btn btn-primary mb-2">Siap Dipickup</button>
                                            <button type="submit" name="status" value="sedang dikirim" class="btn btn-secondary">Sedang Dikirim</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <h4 class="mt-5">Ready or Shipped Orders</h4>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Customer's Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date</th>
                        <th scope="col">Item</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Distance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ready_or_shipped_orders as $order)
                        @foreach ($order->detail_transaksi as $detail)
                            @php
                                $address = $order->customer->addresses->first();
                            @endphp
                            <tr>
                                @if ($loop->first)
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $order->customer->nama }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">
                                        {{ $address->nama_jalan }}<br>
                                        {{ $address->kecamatan }}<br>
                                        {{ $address->kelurahan }}<br>
                                    </td>
                                @endif
                                <td>{{ $order->tgl_transaksi }}</td>
                                <td>{{ $detail->produk->nama }}</td>
                                @if ($loop->first)
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ number_format($order->total_harga, 2, ',', '.') }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $address->jarak }} km</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $order->status }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">
                                        <form action="{{ route('admin.finalizeStatus', $order->id_transaksi) }}" method="POST">
                                            @csrf
                                            <button type="submit" name="status" value="selesai" class="btn btn-primary mb-2">Sudah Dipickup</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection
