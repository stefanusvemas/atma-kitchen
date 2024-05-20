@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <div class="card mb-3 p-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{asset($produk['gambar'])}}" class="img-fluid rounded" style="height: 280px; aspect-ratio: 16/9; object-fit:cover;" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="card-title">{{$produk['nama']}}</h2>
                                @if ($produk['id_penitip'] != null)
                                <p class="card-text">Penitip: <strong>{{$produk['penitip']['nama']}}</strong></p>
                                @endif
                                @if ($produk['deskripsi'] != null)
                                <p class="card-text">{{$produk['deskripsi']}}</p>
                                @else
                                <p class="card-text h-100"></p>
                                @endif

                                @if ($produk['stok'] <= 0 && $produk['kuota_produksi'] <=0) <a href="#" class="btn btn-dark disabled">Order Now</a>
                                    <a href="#" class="btn btn-outline-dark disabled"><i class="fa fa-cart-plus"></i></a>
                                    @else
                                    <a href="#" class="btn btn-dark">Order Now</a>
                                    <a href="#" class="btn btn-outline-dark"><i class="fa fa-cart-plus"></i></a>


                                    @endif
                            </div>
                            <div class="col-auto">
                                <h3>Rp. {{number_format($produk['harga'],2,",",".")}}</h3>
                                @if ($produk['stok'] > 0)
                                <span class="badge text-bg-dark">Stock: {{$produk['stok']}}</span>

                                @elseif ($produk['stok'] == 0 && $produk['kuota_produksi'] == 0)
                                <span class="badge text-black-50">Out of Stock</span>
                                @endif

                                @if ($produk['kuota_produksi'] > 0)
                                <span class="badge text-bg-success">Kuota Produksi: {{$produk['kuota_produksi']}}</span>
                                <span class="badge text-bg-success">Preorder</span>
                                @elseif ($produk['kuota_produksi'] == 0 && $produk['stok'] == 0)
                                <span class="badge text-black-50">Out of Quota</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <h2 class="text-center mt-5">Produk Lainnya</h2>
            </div>
        </div>
        <div class="row">
            @forelse($produk_lain as $produk)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{asset($produk['gambar'])}}" class="card-img-top" alt="Menu Item" height="280px" style="aspect-ratio:1/1; object-fit: cover;">
                    <div class="card-body">
                        <a href="{{url('/detail_product'.'/'.$produk['id_produk'])}}" class="card-title text-decoration-none">
                            <h5>{{$produk['nama']}}</h5>
                        </a>
                        @if ($produk['stok'] <= 0 && $produk['kuota_produksi'] <=0) <a href="#" class="btn btn-dark disabled">Order Now</a>
                            <a href="#" class="btn btn-outline-dark disabled"><i class="fa fa-cart-plus"></i></a>
                            @else
                            <a href="#" class="btn btn-dark">Order Now</a>
                            <a href="#" class="btn btn-outline-dark"><i class="fa fa-cart-plus"></i></a>


                            @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-danger text-center">
                No products found.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection