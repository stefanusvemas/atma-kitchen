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
        @foreach ($productList as $product)
            @if(!empty($product) && !empty($product['resep']))
                @foreach ($product['resep'] as $index => $resep)
                    @if(!empty($resep) && !empty($resep['bahan_baku']))
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ count($product['resep']) }}">{{ $product['nama'] }}</td>
                            @endif
                            <td>{{ $resep['bahan_baku']['nama'] }}</td>
                            <td>{{ $resep['jumlah_bahan_baku'] }} {{ $resep['satuan'] }}</td>
                            <td rowspan="">
                                <a href="{{url('admin/resep/edit/'.$resep['id_resep'])}}">Edit</a> |
                                <a href="{{url('admin/resep/delete/'.$resep['id_resep'])}}">Hapus</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endforeach
@else
    <tr>
        <td colspan="4" class="text-center">No data</td>
    </tr>
@endif
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection