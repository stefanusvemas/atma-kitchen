@extends('index')
@section('content')

<main class="col-md">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-4">
            <h4>Orders History</h4>
            <div class="row justify-content-between">
                <div class="col">
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari produk...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col" class="w-50">Produk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2" scope="row">2024-01-11 13:23:44</td>
                        <td rowspan="2">200000</td>
                        <td>Kue Putih</td>
                    </tr>
                    <tr>
                        <td>Kue Coklat</td>
                    </tr>
                    <tr>
                        <td scope="row">2024-01-01 13:23:44</td>
                        <td>150000</td>
                        <td>Red Velvet</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection