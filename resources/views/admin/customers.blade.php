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
                    <form action="{{url('/admin/customers/search')}}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari customer...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>


            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama</th>
                        <th>Poin</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customer as $item)
                    <tr>
                        <td scope="row">{{$item['nama']}}</td>
                        <td>{{$item['jumlah_poin']}}</td>
                        <td><a href="{{url('admin/customers/history/'.$item['id_customer'])}}">History Pesanan</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection