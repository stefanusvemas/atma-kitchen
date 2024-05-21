@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <h4>Final Checkout</h4>
        <hr>

        @forelse($produk as $produk)
        <div class="card mb-3 p-3">
            <div class="row justify-content-between">
                <div class="col-md-auto col-4">
                    <img src="{{asset($produk['produk']['gambar'])}}" class="img-fluid rounded" width="180px" alt="..." style="aspect-ratio:1/1; object-fit: cover;">
                </div>
                <div class="col">
                    <h4 class="card-title"><strong>{{$produk['produk']['nama']}}</strong></h4>
                    <h6>Rp. {{number_format($produk['produk']['harga'],2,",",".")}}</h6>
                    <p>Quantity : {{$produk['jumlah']}}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md">
            <div class="alert alert-danger text-center">
                Shopping cart is empty.
            </div>
        </div>
        @endforelse

        <hr>

        <div class="row mt-4 justify-content-center justify-content-sm-between">
            <div class="col-md-6">
                <form action="{{url('checkout/poin')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <h4>Poin</h4>
                        <p>Anda memiliki {{$user_data['jumlah_poin']}} poin, apakah anda ingin menggunakannya?</p>
                        <div class="form-check">
                            @if ($transaksi['poin'] > 0)
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="poin" value="true" checked>
                            @else
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="poin" value="true">
                            @endif
                            <label class="form-check-label" for="exampleCheck1">Gunakan Poin</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

            <hr class="d-block d-sm-none mt-3">

            <div class="col-md-auto col-8">
                <h5>Order Summary</h5>
                <p>Total Items Price: Rp. {{number_format($total_item_price,2,",",".")}}</p>
                <p>Shipping Fee: Rp. {{number_format($ongkir,2,",",".")}}</p>
                <p>Taxes (11% PPN): Rp. {{number_format($taxes,2,",",".")}}</p>
                @if ($transaksi['poin'] > 0)
                <p>Potongan {{$transaksi['poin']/100}} poin: Rp. {{number_format($transaksi['poin'],2,",",".")}}</p>
                @endif
                <hr>
                <div class="text-center">
                    <h5>Grand Total</h5>
                    <p id="grandTotal">Rp.{{number_format($subtotal,2,",",".")}}</p>
                </div>
            </div>

        </div>

        <hr>

        <div class="row justify-content-end mb-5">
            <div class="col">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{url('/cart')}}" class="btn btn-outline-dark d-none d-sm-block"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="col-auto">
                        <a href="{{url('/user/pembayaran')}}"><button class="btn btn-dark" href="">Complete Purchase</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection