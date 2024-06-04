<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bahan Baku Per Periode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table-bordered td, .table-bordered th {
            border: 1px solid black;
        }

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
        <div class="container">
        <h2>Laporan Bahan Baku Per Periode</h2>
        <p>Periode: {{ $tanggal_awal }} - {{ $tanggal_akhir }}</p>
        <p>Tanggal Cetak: {{ date('Y-m-d') }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Satuan</th>
                    <th>Jumlah Penggunaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahanbaku as $bahan)
                    <tr>
                        <td>{{ $bahan['nama'] }}</td>
                        <td>{{ $bahan['satuan'] }}</td>
                        <td>{{ $bahan['jumlah_penggunaan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>