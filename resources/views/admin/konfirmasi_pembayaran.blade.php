@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Payment Confirmation</h3>
            <hr>

            <h4 class="mt-3">Pending Payments</h4>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Customer's Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Date</th>
                        <th scope="col">Item</th>
                        <th scope="col">Total Price (Before Shipping)</th>
                        <th scope="col">Shipping Cost</th>
                        <th scope="col">Total Price (With Shipping)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending_payments as $payment)
                        @php
                            $address = $payment->customer->addresses->first();
                        @endphp
                        @if ($address && $address->jarak)
                            @foreach ($payment->detail_transaksi as $detail)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">{{ $payment->customer->nama }}</td>
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">
                                            {{ $address->nama_jalan }}<br>
                                            {{ $address->kecamatan }}<br>
                                            {{ $address->kelurahan }}<br>
                                        </td>
                                    @endif
                                    <td>{{ $payment->tgl_transaksi }}</td>
                                    <td>{{ $detail->produk->nama }}</td>
                                    @if ($loop->first)
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">{{ number_format($payment->total_harga, 2, ',', '.') }}</td>
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">{{ number_format($payment->calculated_shipping_cost, 2, ',', '.') }}</td>
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">{{ number_format($payment->calculated_total_price, 2, ',', '.') }}</td>
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">{{ $payment->status }}</td>
                                        <td rowspan="{{ $payment->detail_transaksi->count() }}">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $payment->id_transaksi }}">Confirm</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@foreach ($pending_payments as $payment)
    @php
        $address = $payment->customer->addresses->first();
    @endphp
    @if ($address && $address->jarak)
        <div class="modal fade" id="confirmModal{{ $payment->id_transaksi }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ url('/admin/konfirmasi-pembayaran/confirm') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirm Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_transaksi" value="{{ $payment->id_transaksi }}">
                            <div class="mb-3">
                                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                                <input type="number" step="0.01" class="form-control" name="jumlah_pembayaran" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach

@endsection
