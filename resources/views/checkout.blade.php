@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <h4>Final Checkout</h4>
        <hr>

        <div class="card mb-3 p-3">
            <div class="row justify-content-between">
                <div class="col-md-auto col-4">
                    <img src="https://masterytricks.com/wp-content/uploads/2024/02/Naked-Cake-Recipe-Card.jpg" class="img-fluid rounded" width="180px" alt="..." style="aspect-ratio:1/1; object-fit: cover;">
                </div>
                <div class="col">
                    <h4 class="card-title"><strong>Kue Putih</strong></h4>
                    <h6>Rp. 100.000</h6>
                    <p>Qty: 2</p>
                </div>
            </div>
        </div>

        <div class="card mb-3 p-3">
            <div class="row justify-content-between">
                <div class="col-md-auto col-4">
                    <img src="https://masterytricks.com/wp-content/uploads/2024/02/Naked-Cake-Recipe-Card.jpg" class="img-fluid rounded" width="180px" alt="..." style="aspect-ratio:1/1; object-fit: cover;">
                </div>
                <div class="col">
                    <h4 class="card-title"><strong>Second Item</strong></h4>
                    <h6>Rp. 150.000</h6>
                    <p>Qty: 2</p>
                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-4 justify-content-center justify-content-sm-between">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <h5>Delivery Methods</h5>
                        <select class="form-control" id="addressSelect" name="address">
                            <option value="self_pickup">Self Pickup</option>
                            <option value="grab">Grab</option>
                            <option value="gojek">Gojek</option>
                        </select>
                        <h5 class="mt-4">Select Payment Method</h5>
                        <select class="form-control" id="paymentSelect" name="payment">
                            <option value="self_pickup">Bank Transfer</option>
                            <option value="grab">QRIS</option>
                            <option value="gojek">Dana</option>
                        </select>
                    </div>
                </form>
            </div>

            <hr class="d-block d-sm-none mt-3">

            <div class="col-md-auto col-8">
                <h5>Order Summary</h5>
                <p>Total Items Price: Rp. 250.000</p>
                <p>Shipping Fee: Rp. 10,000</p>
                <p>Taxes (11% PPN): Rp. 25,000</p>
                <hr>
                <div class="text-center">
                    <h5>Grand Total</h5>
                    <p id="grandTotal">Rp. 285,000</p>
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
                        <button class="btn btn-dark">Complete Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection