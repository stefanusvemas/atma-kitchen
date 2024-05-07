@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4">
            <h3>Hampers</h3>

            <div class="row justify-content-between mb-3">
                <div class="col">
                    <!-- <a href="{{url('admin/bahan_baku/add')}}" class="btn btn-primary">Tambah Bahan</a> -->
                    <a class="btn btn-primary" href="{{url('admin/hampers/add')}}">Tambah Hampers</a>
                </div>
                <div class="col col-lg-3 mt-md-0 mt-3 col-auto">
                    <form action="{{url('/admin/hampers/search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari hampers...">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>

                </div>
            </div>

            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error')->first() }}
            </div>

            @endif

            @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success')}}
            </div>
            @endif

            <table class="table table-responsive mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="w-50">Nama</th>
                        <th scope="col">Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hampers as $item)
                    @foreach ($item as $detail)
                    <tr>
                        @if ($loop->first)
                        <td rowspan="{{ count($item) }}">{{ $detail['hampers']['nama'] }}</td>
                        @endif
                        <td>{{ $detail['produk']['nama'] }}</td>
                        <td>{{ $detail['jumlah'] }}</td>
                        @if ($loop->first)
                        <td rowspan="{{ count($item) }}">{{ $detail['hampers']['harga'] }}</td>
                        <td rowspan="{{ count($item) }}"><a href="{{url('admin/hampers/edit/'.$detail['hampers']['id_hampers'])}}">Edit</a> | <a href="{{url('admin/hampers/delete/'.$detail['hampers']['id_hampers'])}}">Hapus</a></td>
                        @endif
                    </tr>
                    @endforeach
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