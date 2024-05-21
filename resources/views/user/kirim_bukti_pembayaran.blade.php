@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <h4>Bukti Pembayaran</h4>
        <hr>
        <div class="row mt-4 justify-content-center justify-content-sm-between">

            <div class="card mb-3 p-3 col-md-8">
                <div class="row justify-content-between">
                    <!-- <div class="col-md-auto col-4">
                        <img src="https://masterytricks.com/wp-content/uploads/2024/02/Naked-Cake-Recipe-Card.jpg" class="img-fluid rounded" width="180px" alt="..." style="aspect-ratio:1/1; object-fit: cover;">
                    </div> -->
                    <div class="col">
                        <h4>Masukan Bukti Transfer di bawah ini</h4>
                        <form action="{{url('/user/pembayaranAction')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <!-- <label for="gambar" class="form-label">Gambar</label> -->
                                <input type="file" accept="image/png, image/jpeg" class="form-control" id="foto_bukti" name="foto_bukti" required>
                            </div>
                            <br>
                            <div class="col-auto">
                                <button class="btn btn-dark" type="submit">Complete Purchase</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr class="d-block d-sm-none mt-3">

            <div class="col-md-auto col-8">
                <h5>Order Summary</h5>
                <p>Total Items Price: Rp. {{number_format($total_item_price,2,",",".")}}</p>
                <p>Shipping Fee: Rp. {{number_format($ongkir,2,",",".")}}</p>
                <p>Taxes (11% PPN): {{number_format($taxes,2,",",".")}}</p>
                <hr>
                <div class="text-center">
                    <h5>Grand Total</h5>
                    <p id="grandTotal">Rp.{{number_format($subtotal,2,",",".")}}</p>
                </div>
            </div>

        </div>

        <hr>

        <!-- <div class="row justify-content-end mb-5">
            <div class="col">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{url('/cart')}}" class="btn btn-outline-dark d-none d-sm-block"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark">Complete Purchase</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>

@endsection