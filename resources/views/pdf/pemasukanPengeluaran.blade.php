<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan dan Pengeluaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .header p {
            margin: 0;
            font-size: 16px;
        }

        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .details .underline {
            text-decoration: underline;
            color: blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Atma Kitchen</h1>
            <p>Jl. Centralpark No. 10 Yogyakarta</p>
        </div>
        <div class="report-title">LAPORAN PEMASUKAN DAN PENGELUARAN</div>
        <div class="details">
            <p>Bulan: <span class="underline">Januari</span></p>
            <p>Tahun: 2024</p>
            <p>Tanggal cetak: 10 Februari 2024</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Penjualan</td>
                    <td>108.752.000</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tip</td>
                    <td>207.000</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Listrik</td>
                    <td></td>
                    <td>3.890.000</td>
                </tr>
                <tr>
                    <td>Gaji Karyawan</td>
                    <td></td>
                    <td>11.800.000</td>
                </tr>
                <tr>
                    <td>Bahan Baku</td>
                    <td></td>
                    <td>49.600.250</td>
                </tr>
                <tr>
                    <td>Iuran RT</td>
                    <td></td>
                    <td>500.000</td>
                </tr>
                <tr>
                    <td>Bensin</td>
                    <td></td>
                    <td>900.000</td>
                </tr>
                <tr>
                    <td>Gas</td>
                    <td></td>
                    <td>2.200.000</td>
                </tr>
                <tr>
                    <td>....</td>
                    <td></td>
                    <td>....</td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td>....</td>
                    <td>....</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>