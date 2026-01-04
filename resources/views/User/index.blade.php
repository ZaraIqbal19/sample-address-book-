@extends('user.layout')
@section('content')

<!-- Carousel -->
<div id="homepageCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1600180758895-5562cba92b87?auto=format&fit=crop&w=1600&q=80"
                 class="d-block w-100 vh-100 object-fit-cover" alt="Cosmetics">
            <div class="carousel-caption d-flex flex-column justify-content-center text-start h-100 px-5">
                <h1 class="display-2 fw-bold">Cosmetics Collection</h1>
                <p class="text-white-50 fs-4">Premium cosmetics for a flawless look.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">Explore Cosmetics</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1562339736-b6f0f2f1d621?auto=format&fit=crop&w=1600&q=80"
                 class="d-block w-100 vh-100 object-fit-cover" alt="Jewellery">
            <div class="carousel-caption d-flex flex-column justify-content-center text-start h-100 px-5">
                <h1 class="display-2 fw-bold">Jewellery Collection</h1>
                <p class="text-white-50 fs-4">Timeless elegance for every occasion.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">Explore Jewellery</a>
            </div>
        </div>

    </div>
</div>

<!-- Categories Section -->
@php
$categories = [
    [
        'name' => 'Cosmetics',
        'link' => '#',
        'image' => 'https://images.pexels.com/photos/2721977/pexels-photo-2721977.jpeg'
    ],
    [
        'name' => 'Jewellery',
        'link' => '#',
        'image' => 'https://images.pexels.com/photos/7598170/pexels-photo-7598170.jpeg'
    ],
];
@endphp

<div class="container py-5">
    <div class="text-center mb-5">
        <h5 class="text-muted">Categories</h5>
        <h1 class="fw-bold">Our Collections</h1>
    </div>

    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-md-6 col-lg-4">
                <a href="{{ $category['link'] }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ $category['image'] }}" class="card-img-top" style="height:260px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-semibold text-dark">{{ $category['name'] }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Dynamic Product Sections -->
@php
$sections = [
    ['title' => 'Latest Products', 'products' => $normalProducts],
    ['title' => 'Best Sellers', 'products' => $bestSellers],
    ['title' => 'New Arrivals', 'products' => $newArrivals],
    ['title' => 'On Sale', 'products' => $onSaleProducts],
];
@endphp

@foreach($sections as $section)
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="text-muted">{{ $section['title'] }}</h5>
            <h2 class="fw-bold">{{ $section['title'] }}</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary">See More</a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @forelse($section['products'] as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-danger fw-bold mb-3">Rs {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('product.detail', $product->id) }}" class="btn btn-primary mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No products available in this section.</p>
        @endforelse
    </div>
</div>
@endforeach
@endsection
