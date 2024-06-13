<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .invoice-title {
            margin-top: 20px;
        }

        .invoice-header {
            margin-bottom: 30px;
        }

        .table {
            margin-top: 30px;
        }

        .total-row {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row invoice-title">
            <div class="col-md-12">
                <h1>Atma Kicthen</h1>
                <p>Jl. Centralpark No. 10 Yogyakarta</p>
            </div>
        </div>
        <div class="row invoice-header">
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>No nota</td>
                        <td>:</td>
                        <td>{{$data['no_nota']}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal pesan</td>
                        <td>:</td>
                        <td>{{$data['transaksi']['tgl_transaksi']}}</td>
                    </tr>
                    <tr>
                        <td>Lunas pada</td>
                        <td>:</td>
                        <td>{{$data['transaksi']['pembayaran']['tgl_konfirmasi']}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal ambil</td>
                        <td>:</td>
                        <td>{{$data['transaksi']['tgl_ambil']}}</td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="col-md-6 text-right">
                <p><strong>Customer</strong> : {{$email}} / {{$data['transaksi']['customer']['nama']}}
                    <br>
                    @if ($pengiriman != null)
                    {{$pengiriman['alamat']['nama_jalan']. ', ' . $pengiriman['alamat']['kecamatan'] . ', '. $pengiriman['alamat']['kelurahan']}}
                    <br>
                    Delivery: {{$pengiriman['jenis']}}
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                        @forelse($detail_transaksi as $item)
                        <tr>
                            <td colspan="2">{{$item['jumlah']}} {{$item['produk']['nama']}}</td>
                            <td>Rp. {{number_format($item['produk']['harga'],2,",",".")}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">Tidak ada data</td>
                        </tr>
                        @endforelse
                        <br>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rp. {{number_format($data['transaksi']['total_harga']+$data['transaksi']['poin'],2,",",".")}}</td>
                        </tr>
                        @if ($pengiriman != null)
                        <tr>
                            <td colspan="2">Ongkos Kirim (rad. {{$pengiriman['alamat']['jarak']}} km)</td>
                            <td>Rp. {{number_format($pengiriman['alamat']['jarak']*2000,2,",",".")}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rp. {{number_format($pengiriman['alamat']['jarak']*2000+$data['transaksi']['total_harga'],2,",",".")}}</td>
                        </tr>
                        @endif
                        @if ($data['transaksi']['poin'] > 0)
                        <tr>
                            <td colspan="2">Potongan {{$data['transaksi']['poin']/100}} poin</td>
                            <td>-{{$data['transaksi']['poin']}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>Rp. {{number_format($pengiriman['alamat']['jarak']*2000+$data['transaksi']['total_harga']-$data['transaksi']['poin'],2,",",".")}}</td>
                        </tr>

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <p>Poin dari pesanan ini: {{$poinEarned}} <br>
                    Total poin customer: {{$data['transaksi']['customer']['jumlah_poin']}}</p>
            </div>
        </div>
    </div>
</body>

</html>