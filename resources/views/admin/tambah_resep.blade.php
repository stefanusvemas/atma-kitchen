@extends('admin/index')
@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="content">
        <div class="container mt-4 bg-light rounded-3 p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/resep')}}">Resep</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <h4>Tambah Resep</h4>
            <form action="{{url('/admin/resep/add')}}" class="p-3" method="post">
                @csrf
                <label for="produk">Nama produk</label>
                <select class="form-select mb-2" aria-label="Default select example" name="id_produk">
                    <option selected disabled>Pilih produk</option>

                    @forelse ($produk as $item)
                    <option value="{{$item['id_produk']}}">{{$item['nama']}}</option>
                    @empty
                    <tr>
                        <td colspan="4">No data</td>
                    </tr>
                    @endforelse

                </select>
                <label for="bahan">Bahan baku</label>
                <select class="form-select mb-2" aria-label="Default select example" name="id_bahan_baku">
                    <option selected disabled>Pilih bahan baku</option>
                    @forelse ($bahan_baku as $item)
                    <option value="{{$item['id_bahan_baku']}}">{{$item['nama']}}</option>
                    @empty
                    <tr>
                        <td colspan="4">No data</td>
                    </tr>
                    @endforelse
                </select>
                <div class="mb-2">
                    <label for="harga" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="harga" min="0" name="jumlah_bahan_baku">
                </div>
                <label for="bahan">Satuan</label>
                <select class="form-select mb-2" aria-label="Default select example" name="satuan">
                    <option selected disabled>Pilih satuan</option>
                    <option value="mg">Miligram (mg)</option>
                    <option value="g">Gram (g)</option>
                    <option value="kg">Kilogram (kg)</option>
                    <option value="ml">Mililiter (ml)</option>
                    <option value="l">Liter (l)</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>

@endsection