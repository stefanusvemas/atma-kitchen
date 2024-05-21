@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Address Distance</h3>
            <hr>

            <h4 class="mt-3">Addresses Without Distance</h4>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Customer's Name</th>
                        <th scope="col">Street</th>
                        <th scope="col">Sub-district</th>
                        <th scope="col">Village</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($addresses as $address)
                        <tr>
                            <td>{{ $address->customer->nama }}</td>
                            <td>{{ $address->nama_jalan }}</td>
                            <td>{{ $address->kecamatan }}</td>
                            <td>{{ $address->kelurahan }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#inputDistanceModal{{ $address->id_alamat }}">Input Distance</a>
                                <form id="updateDistanceForm{{ $address->id_alamat }}" action="{{ url('/admin/address/update-distance', $address->id_alamat) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="jarak" value="0">
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No addresses without distance</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <h4 class="mt-5">Order Information</h4>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Customer's Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Item</th>
                        <th scope="col">Total Price (Before Shipping)</th>
                        <th scope="col">Shipping Cost</th>
                        <th scope="col">Total Price (With Shipping)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->detail_transaksi as $detail)
                            <tr>
                                @if ($loop->first)
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $order->customer->nama }}</td>
                                @endif
                                <td>{{ $order->tgl_transaksi }}</td>
                                <td>{{ $detail->produk->nama }}</td>
                                @if ($loop->first)
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">{{ $order->total_harga }}</td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">
                                        @php
                                            $address = $order->customer->addresses->first();
                                            $shipping_cost = $address ? $address->jarak * $shipping_rate : 0;
                                        @endphp
                                        {{ $shipping_cost }}
                                    </td>
                                    <td rowspan="{{ $order->detail_transaksi->count() }}">
                                        @php
                                            $total_price = $order->total_harga;
                                        @endphp
                                        {{ $total_price }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modals for inputting distance -->
    @foreach ($addresses as $address)
        <div class="modal fade" id="inputDistanceModal{{ $address->id_alamat }}" tabindex="-1" aria-labelledby="inputDistanceModalLabel{{ $address->id_alamat }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputDistanceModalLabel{{ $address->id_alamat }}">Input Distance for {{ $address->customer->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('admin/address/input-distance/'.$address->id_alamat) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="jarak{{ $address->id_alamat }}" class="form-label">Distance (km)</label>
                                <input type="number" step="0.01" class="form-control" name="jarak" id="jarak{{ $address->id_alamat }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</main>

@endsection
