@extends('index')
@section('content')

<div class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md">
                <div class="text-center">
                    <img src="https://masterytricks.com/wp-content/uploads/2024/02/Naked-Cake-Recipe-Card.jpg" alt="" class="img-fluid" height="400" style="border-radius: 30px;">
                </div>
            </div>
            <div class="col-md  order-md-last">
                <h1 style="font-family: 'Playfair Display', serif;">
                    Where Flavor Meets Soul, Every Dish Tells a Story
                </h1>
                <p>
                    Welcome to <strong>Atma Kitchen</strong>, where every dish is a story waiting to be tasted. Our chefs blend tradition with innovation, crafting culinary experiences that ignite the senses. From carefully sourced ingredients to bold flavors, each bite is a journey of authenticity and delight.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <h2 class="text-center mt-5">Our Menu</h2>
            </div>
        </div>

        <div class="row mt-4">
            @forelse($produk as $produk)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{asset($produk['gambar'])}}" class="card-img-top" alt="Menu Item" height="380px" style="aspect-ratio:1/1; object-fit: cover;">
                    <div class="card-body">
                        <a href="{{url('/detail_product'.'/'.$produk['id_produk'])}}" class="card-title text-decoration-none">
                            <h5>{{$produk['nama']}}</h5>
                        </a>
                        <p class="card-text">Rp. {{number_format($produk['harga'],2,",",".")}}</p>
                        @if ($produk['stok'] <= 0 && $produk['kuota_produksi'] <=0) <a href="#" class="btn btn-dark disabled">Order Now</a>
                            <a href="#" class="btn btn-outline-dark disabled"><i class="fa fa-cart-plus"></i></a>
                            @else
                            <a href="{{url('/addToCart'.'/'.$produk['id_produk'])}}" class="btn btn-dark">Order Now</a>
                            <a href="{{url('/actionAddCart'.'/'.$produk['id_produk'])}}" class="btn btn-outline-dark"><i class="fa fa-cart-plus"></i></a>


                            @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md">
                <div class="alert alert-danger text-center">
                    No products found.
                </div>
            </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-md">
                <h2 class="text-center mt-2">Reviews</h2>
            </div>
        </div>

        <div id="carouselExample" class="carousel carousel-dark slide " data-bs-ride="true">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">John Doe</h5>
                                    <p class="card-text">"The cakes at Atma Kitchen are absolutely delicious! I've ordered multiple times and have never been disappointed. Highly recommend!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jane Smith</h5>
                                    <p class="card-text">"I had the pleasure of trying their Red Velvet cake, and it was divine! Moist, flavorful, and simply delightful. Can't wait to order again!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Michael Johnson</h5>
                                    <p class="card-text">"Atma Kitchen's Red Velvet cake is hands down the best I've ever tasted! Perfect balance of sweetness and texture. Will definitely be coming back for more!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev d-none d-lg-block" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next d-none d-lg-block" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </div>
</div>

@endsection