<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Invoice</title> -->
    <title>Laporan Presensi Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Atma Kitchen</h1>
    <p>Jl. Centralpark No. 10 Yogyakarta</p>
    <h2>LAPORAN Presensi Karyawan</h2>
    <p>Bulan : {{ $bulan }}</p>
    <p>Tahun: {{ $tahun }}</p>
    <p>Tanggal cetak: {{ $tanggal_cetak }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Hadir</th>
                <th>Jumlah Bolos</th>
                <th>Honor Harian</th>
                <th>Bonus Rajin</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row['nama'] }}</td>
                <td>{{ $row['jumlah_hadir'] }}</td>
                <td>{{ $row['jumlah_bolos'] }}</td>
                <td>{{ number_format($row['honor_harian'], 0, ',', '.') }}</td>
                <td>{{ number_format($row['bonus_rajin'], 0, ',', '.') }}</td>
                <td>{{ number_format($row['total'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5">Total</td>
                <td>{{ number_format($total_biaya, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>