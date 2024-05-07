@extends('manager/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('manager/pembelian_bahan_baku')}}">Edit Bahan Baku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h4>Edit Penitip</h4>
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')->first()}}
            </div>
            @endif

            <form action="{{url('manager/pembelian_bahan_baku/edit/'.$pembelian['id_pembelian'])}}" method="post" class="p-3">
                @csrf
                <div class="mb-2">
                    <label for="nama" class="form-label">Bahan Baku</label>
                    <select class="form-select" name="id_bahan_baku" id="nama">
                        <option value="{{$pembelian['bahan_baku']['id_bahan_baku']}}" hidden selected>{{$pembelian['bahan_baku']['nama']}}</option>
                        @foreach ($bahan_baku as $bahan)
                        <option value="{{$bahan['id_bahan_baku']}}">{{$bahan['nama']}}</option>
                        @endforeach
                    </select>

                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{$pembelian['jumlah_pembelian']}}">

                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga" value="{{$pembelian['total_harga']}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection