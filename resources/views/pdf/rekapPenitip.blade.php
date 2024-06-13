<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Penitip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }

        h1,
        h2 {
            text-align: center;
        }

        p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>


<body>

    <div class="container">
        @foreach($penitips as $penitip)
        <h1>Atma Kitchen</h1>
        <p>Jl. Centralpark No. 10 Yogyakarta</p>
        <h2>LAPORAN TRANSAKSI PENITIP</h2>
        <!-- Loop through each penitip -->

        <p><strong>ID Penitip :</strong> {{ $penitip->id_penitip }}</p>
        <p><strong>Nama Penitip :</strong> {{ $penitip->nama }}</p>
        <p><strong>Bulan :</strong> {{ $bulan }}</p>
        <p><strong>Tahun :</strong> {{ $tahun }}</p>
        <p><strong>Tanggal cetak :</strong> {{ $tanggalCetak }}</p>
        <!-- Add other penitip information as needed -->

        <!-- Table to display products -->
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Qty</th>
                    <th>Harga Jual</th>
                    <th>Total</th>
                    <th>20% Komisi</th>
                    <th>Yang Diterima</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each product of the penitip -->
                @foreach($penitip->produk as $produk)
                <tr>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($produk->stok * $produk->harga, 0, ',', '.') }}</td>
                    <td>{{ number_format(($produk->stok * $produk->harga) * 20 / 100, 0, ',', '.') }}</td>
                    <td>{{ number_format(($produk->stok * $produk->harga) - ($produk->stok * $produk->harga) * 20 / 100, 0, ',', '.') }}</td>
                </tr>
                </tr>
                @endforeach
            </tbody>
            <!-- Add footer if necessary -->
        </table>
        @endforeach
    </div>
</body>

</html>