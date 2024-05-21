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
                        <td>24.02.101</td>
                    </tr>
                    <tr>
                        <td>Tanggal pesan</td>
                        <td>:</td>
                        <td>15/2/2024 18:50</td>
                    </tr>
                    <tr>
                        <td>Lunas pada</td>
                        <td>:</td>
                        <td>15/2/2024 19:01</td>
                    </tr>
                    <tr>
                        <td>Tanggal ambil</td>
                        <td>:</td>
                        <td>15/2/2024 19:01</td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="col-md-6 text-right">
                <p><strong>Customer</strong> : cath123@gmail.com / Catherine
                    <br>
                    Perumahan Griya Persada XII/20
                    Caturtunggal, Depok, Sleman
                    <br>
                    Delivery: Kurir Yummy Kitchen
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="2">1 Product 1</td>
                            <td>$100.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">1 Service 1</td>
                            <td>$150.00</td>
                        </tr>
                        <br>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>$250.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Ongkos Kirim (rad. 5 km)</td>
                            <td>$250.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>$250.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Potongan 120 poin</td>
                            <td>-12.000</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total</td>
                            <td>$250.00</td>
                        </tr>
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
                <p>Poin dari pesanan ini: 106 <br>
                    Total poin customer: 110</p>
            </div>
        </div>
    </div>
</body>

</html>