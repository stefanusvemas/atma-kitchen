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

        .table,
        tr.laporan,
        td.laporan,
        th.laporan {
            border-collapse: collapse;
            border: 1px solid black;
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
            <div class="col">
                <h3><u>LAPORAN Stok Bahan Baku</u></h3>
                <table>
                    <tr>
                        <td>Tanggal cetak</td>
                        <td>:</td>
                        <td>{{$tgl_cetak}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <table class="table">
                    <tbody>
                        <tr class="laporan">
                            <th class="laporan">Nama Bahan</th>
                            <th class="laporan">Satuan</th>
                            <th class="laporan">Stok</th>
                        </tr>
                        @forelse($data as $bahan)
                        <tr>
                            <td class="laporan">
                                {{$bahan->nama}}
                            </td>
                            <td class="laporan">
                                {{$bahan->satuan}}
                            </td>
                            <td class="laporan">
                                {{number_format($bahan->stok, 0, ',', '.')}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="laporan text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>