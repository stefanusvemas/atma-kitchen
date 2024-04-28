@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Customers</h3>

            <div class="row justify-content-between">
                <div class="col">

                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari customer...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama</th>
                        <th>Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Budi</td>
                        <td>budi@customer.com</td>
                        <td><a href="{{url('admin/customers/history')}}">History Pesanan</a></td>
                    </tr>
                    <tr>
                        <td scope="row">John</td>
                        <td>john@customer.com</td>
                        <td><a href="#">History Pesanan</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection