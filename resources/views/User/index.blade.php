{{-- resources/views/user/index.blade.php --}}
@extends('user.layout')

@section('content')

{{-- Main Carousel --}}
<div id="header-carousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('User/img/carousel-1.jpg') }}" class="d-block w-100" style="height:80vh; object-fit:cover;" alt="Jewellery">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="fw-bold">Luxury Jewellery</h1>
                <p>Discover timeless elegance crafted with perfection.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('User/img/carousel-2.jpg') }}" class="d-block w-100" style="height:80vh; object-fit:cover;" alt="Cosmetics">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="fw-bold">Premium Cosmetics</h1>
                <p>Enhance your natural beauty with our exclusive range.</p>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

{{-- Helper to display a product card --}}
@php
    function renderProductCard($product, $badge = null) {
        $badgeHtml = '';
        if ($badge) {
            $badgeHtml = '<span class="badge bg-danger position-absolute" style="top:10px; left:10px;">'.$badge.'</span>';
        } elseif($product->discount_price && $product->discount_price < $product->price) {
            $badgeHtml = '<span class="badge bg-success position-absolute" style="top:10px; left:10px;">On Sale</span>';
        } elseif($product->sku <= 0) {
            $badgeHtml = '<span class="badge bg-secondary position-absolute" style="top:10px; left:10px;">Out of Stock</span>';
        } else {
            $badgeHtml = '<span class="badge bg-info position-absolute" style="top:10px; left:10px;">In Stock</span>';
        }

        $priceDisplay = $product->discount_price && $product->discount_price < $product->price
            ? '<span class="text-muted text-decoration-line-through">Rs '.number_format($product->price,2).'</span> <span class="fw-bold text-danger">Rs '.number_format($product->discount_price,2).'</span>'
            : 'Rs '.number_format($product->price,2);

        return '
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 position-relative product-card">
                '.$badgeHtml.'
                <img src="'.asset('products/'.$product->image).'" class="card-img-top" style="height:280px; object-fit:cover;" alt="'.$product->name.'">
                <div class="card-body text-center">
                    <h5 class="fw-semibold mb-2">'.$product->name.'</h5>
                    <p class="mb-2">'.$priceDisplay.'</p>
                    <a href="'.route('product.description', $product->id).'" class="btn btn-outline-dark btn-sm">View Product</a>
                </div>
            </div>
        </div>';
    }
@endphp

{{-- Section: Best Sellers --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Best Sellers</h2>
                <p class="text-muted">Most loved by our customers</p>
            </div>
            <a href="{{ url('/user/products') }}" class="btn btn-dark">See More</a>
        </div>
        <div class="row g-4">
            @foreach($bestSellers->take(6) as $product)
                {!! renderProductCard($product, 'Best Seller') !!}
            @endforeach
        </div>
    </div>
</section>

{{-- Section: New Arrivals --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">New Arrivals</h2>
                <p class="text-muted">Freshly added for you</p>
            </div>
            <a href="{{ url('/user/products') }}" class="btn btn-dark">See More</a>
        </div>
        <div class="row g-4">
            @foreach($newArrivals->take(6) as $product)
                {!! renderProductCard($product, 'New Arrival') !!}
            @endforeach
        </div>
    </div>
</section>

{{-- Section: On Sale --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">On Sale</h2>
                <p class="text-muted">Grab them before they are gone</p>
            </div>
            <a href="{{ url('/user/products') }}" class="btn btn-dark">See More</a>
        </div>
        <div class="row g-4">
            @foreach($onSale->take(6) as $product)
                {!! renderProductCard($product, 'On Sale') !!}
            @endforeach
        </div>
    </div>
</section>

{{-- Section: In Stock --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">In Stock</h2>
                <p class="text-muted">Available products ready to ship</p>
            </div>
            <a href="{{ url('/user/products') }}" class="btn btn-dark">See More</a>
        </div>
        <div class="row g-4">
            @foreach($inStock->take(6) as $product)
                {!! renderProductCard($product) !!}
            @endforeach
        </div>
    </div>
</section>

{{-- Optional styles --}}
<style>
    .product-card img {
        transition: 0.4s ease;
    }
    .product-card:hover img {
        transform: scale(1.05);
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.7em;
    }
</style>

@endsection
