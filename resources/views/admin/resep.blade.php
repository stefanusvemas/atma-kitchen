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
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari resep...">
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
                    @foreach($produk as $produk)
                    @foreach($produk['resep'] as $resep)
                    <tr>
                        <!-- @if ($resep !== 0)
                        <td rowspan="{{ count($produk->resep) }}">{{ $produk['nama'] }}</td>
                        @endif -->
                        <td>{{ $produk['nama'] }}</td>
                        <td>{{ $resep['bahanBaku']['nama'] }}</td>
                        <td>{{ $resep['jumlah_bahan_baku'] }} {{ $resep['satuan'] }}</td>

                        <td><a href="{{url('admin/resep/edit/'.$resep['id_bahan_baku'])}}">Edit</a> | <a href="#">Hapus</a></td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</main>

@endsection