@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Customer History</h3>

            <div class="row justify-content-between">
                <div class="col">

                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari history...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Tanggal Transaksi</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th scope="col">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2">2024-02-12</td>
                        <td>Red Velvet</td>
                        <td>1</td>
                        <td rowspan="2">Rp. 140,000</td>
                    </tr>
                    <tr>
                        <td>Kue Putih</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td rowspan="2">2024-02-02</td>
                        <td>Kue Coklat</td>
                        <td>1</td>
                        <td rowspan="2">Rp. 140,000</td>
                    </tr>
                    <tr>
                        <td>Kue Putih</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection