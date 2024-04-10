@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <h4>Shopping Cart</h4>
        <hr>

        <div class="card mb-3 p-3">
            <div class="row justify-content-between">
                <div class="col-md-auto col-4">
                    <img src="https://masterytricks.com/wp-content/uploads/2024/02/Naked-Cake-Recipe-Card.jpg" class="img-fluid rounded" width="180px" alt="..." style="aspect-ratio:1/1; object-fit: cover;">
                </div>
                <div class="col">
                    <h4 class="card-title"><strong>Kue Putih</strong></h4>
                    <p>Rp. 100.000</p>
                </div>
                <div class="col-auto">
                    <div class="row">
                        <div class="col">
                            <span class="badge text-bg-dark">Stock: 10</span>
                            <span class="badge text-bg-success">Preorder</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <label for="quantityInput1" class="form-label">Quantity:</label>
                            <input type="number" class="form-control quantity-input" id="quantityInput1" value="1" min="1" max="10" data-price="100000">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <a href="#" class="btn btn-outline-danger remove-item"><i class="fa fa-trash"></i> Remove Item</a>
                        </div>
                    </div>
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
                    <p>Rp. 150.000</p>
                </div>
                <div class="col-auto">
                    <div class="row">
                        <div class="col">
                            <span class="badge text-bg-dark">Stock: 5</span>
                            <span class="badge text-bg-success">Preorder</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <label for="quantityInput2" class="form-label">Quantity:</label>
                            <input type="number" class="form-control quantity-input" id="quantityInput2" value="1" min="1" max="5" data-price="150000">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <a href="#" class="btn btn-outline-danger remove-item"><i class="fa fa-trash"></i> Remove Item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <hr>

        <div class="row justify-content-between mb-5">
            <div class="col-md-auto col-8">
                <h5>Total</h5>
                <p id="grandTotal">Rp. 0</p>
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