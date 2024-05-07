@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Resep</h3>

            <div class="row justify-content-between">
                <div class="col">
                    <a href="{{url('admin/resep/add')}}" class="btn btn-primary">Tambah Resep</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('admin/resep/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari resep...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col" class="w-75">Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($products))
                    @foreach ($products as $productId => $productList)
                    @foreach ($productList as $index => $product)
                    <tr>
                        @if ($index === 0)
                        <td rowspan="{{ count($productList) }}">{{ $product['nama'] }}</td>
                        <td rowspan="{{ count($productList) }}">{{ $product['harga'] }}</td>
                        @endif
                        <td>{{ $product['nama'] }}</td>
                        <td>{{ $product['harga'] }}</td>
                        <!-- Add more columns to display other attributes as needed -->
                    </tr>
                    @endforeach
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">No data</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection