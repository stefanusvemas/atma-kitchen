@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <h4>Shopping Cart</h4>
        <hr>

        @forelse($produk as $produk)
        <div class="card mb-3 p-3">
            <div class="row justify-content-between">
                <div class="col-md-auto col-4">
                    <img src="{{asset($produk['produk']['gambar'])}}" class="img-fluid rounded" width="180px" alt="..." style="aspect-ratio:1/1; object-fit: cover;">
                </div>
                <div class="col">
                    <h4 class="card-title"><strong>{{$produk['produk']['nama']}}</strong></h4>
                    @if ($produk['produk']['id_penitip'] == null)
                    <span class="badge rounded-pill text-bg-primary">Kuota : {{$remainingQuota[$produk['produk']['id_produk']]}}</span>
                    @else
                    <span class="badge rounded-pill text-bg-success">Stok : {{$remainingQuota[$produk['produk']['id_produk']]}}</span>
                    @endif
                    <p>Rp. {{number_format($produk['produk']['harga'],2,",",".")}}</p>
                </div>
                <div class="col-auto">
                    <form action="{{ url('/cart/update/' . $produk['produk']['id_produk']) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <label for="quantityInput{{$produk['produk']['id_produk']}}" class="form-label">Quantity:</label>
                                <input type="number" name="jumlah" class="form-control quantity-input" id="quantityInput{{$produk['produk']['id_produk']}}" value="{{$produk['jumlah']}}" min="1" max="10" data-price="{{$produk['produk']['harga']}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-outline-primary">Update</button>
                                <a href="{{url('/removeCart'.'/'.$produk['produk']['id_produk'])}}" class="btn btn-outline-danger remove-item"><i class="fa fa-trash"></i> Remove Item</a>
                            </div>
                        </div>
                    </form>
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

        <div class="row mb-2">
            <form action="{{url('/cart/updateTglAmbil')}}" method="post" class="d-flex align-items-center">
                @csrf
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal_ambil" class="me-2">Tanggal Ambil</label>
                            <input type="date" class="form-control me-2" name="tanggal_ambil" id="tanggal_ambil" min="{{date('Y-m-d')}}" value="{{$transaksi['tgl_ambil']}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Alamat</label>
                            <select class="form-control" id="addressSelect" name="alamat" required>
                                <option value="" selected>Pilih Alamat</option>
                                @if ($alamat_selected != null)
                                <option value="{{$alamat_selected['id_alamat']}}" selected hidden>{{$alamat_selected['alamat']['nama_jalan']}}</option>
                                @endif
                                <option value="-1">Self Pickup</option>

                                @forelse($alamat as $item)
                                <option value="{{$item['id_alamat']}}">{{$item['nama_jalan']}}</option>
                                @empty
                                <option value="0" disabled>No address</option>
                                @endforelse
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Metode Pengiriman</label>
                            <select class="form-control" id="addressSelect" name="jenis" required>
                                <option value="" selected>Pilih Pengiriman</option>
                                @if ($alamat_selected != null)
                                <option value="{{$alamat_selected['jenis']}}" selected hidden>{{$alamat_selected['jenis']}}</option>
                                @endif
                                <option value="self_pickup">Self Pickup</option>
                                <option value="grab">Grab</option>
                                <option value="gojek">Gojek</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i></button>

                        </div>
                    </div>

                </div>
            </form>

        </div>

        <hr>

        <div class="row justify-content-between mb-5">
            <div class="col-md-auto col-8">
                <h5>Total</h5>
                <p id="grandTotal">Rp. 0</p>
            </div>
            <div class="col-md-auto col-4">

            </div>
            <div class="col-md-auto col-4">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{url('/')}}" class="btn btn-outline-dark d-none d-sm-block">Continue Shopping</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{url('/checkout')}}" class="btn btn-dark">Checkout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');

        function calculateGrandTotal() {
            let grandTotal = 0;
            quantityInputs.forEach(function(input) {
                let price = parseFloat(input.getAttribute('data-price'));
                let quantity = parseInt(input.value);
                grandTotal += price * quantity;
            });
            document.getElementById('grandTotal').textContent = 'Rp. ' + grandTotal.toFixed(2);
        }

        quantityInputs.forEach(function(input) {
            input.addEventListener('input', calculateGrandTotal);
        });

        calculateGrandTotal();
    });
</script>

@endsection