@extends('user.layout')
@section('content')

{{-- ===================== HERO CAROUSEL ===================== --}}
<div id="header-carousel" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1"></button>
    </div>

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{ asset('User/img/carousel-1.jpg') }}" class="d-block w-100 hero-img">
            <div class="carousel-caption hero-caption">
                <h1 data-aos="fade-down">Luxury Jewellery</h1>
                <p data-aos="fade-up" data-aos-delay="150">
                    Timeless elegance crafted with brilliance, precision,
                    and artistry — designed to elevate every moment.
                </p>
                <a href="{{ url('/user/products') }}"
                   class="btn btn-accent btn-lg"
                   data-aos="zoom-in"
                   data-aos-delay="300">
                    Shop Collection
                </a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('User/img/carousel-2.jpg') }}" class="d-block w-100 hero-img">
            <div class="carousel-caption hero-caption">
                <h1 data-aos="fade-down">Premium Cosmetics</h1>
                <p data-aos="fade-up" data-aos-delay="150">
                    Indulge in luxury beauty essentials that enhance confidence,
                    glow, and self-expression.
                </p>
                <a href="{{ url('/user/products') }}"
                   class="btn btn-accent btn-lg"
                   data-aos="zoom-in"
                   data-aos-delay="300">
                    Explore Beauty
                </a>
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

{{-- ===================== PRODUCT CARD HELPER (LOGIC UNCHANGED) ===================== --}}
@php
function renderProductCard($product, $badge = null) {

    $badgeClasses = [
        'Best Seller' => 'badge-best',
        'New Arrival' => 'badge-new',
        'On Sale'     => 'badge-sale',
        'In Stock'    => 'badge-stock',
        'Out of Stock'=> 'badge-out',
    ];

    if ($product->sku <= 0) {
        $badge = 'Out of Stock';
    }

    $badgeClass = $badgeClasses[$badge] ?? 'badge-stock';

    $price = $product->discount_price && $product->discount_price < $product->price
        ? '<span class="old-price">Rs '.number_format($product->price,2).'</span>
           <span class="new-price">Rs '.number_format($product->discount_price,2).'</span>'
        : '<span class="new-price">Rs '.number_format($product->price,2).'</span>';

    return '
    <div class="col-xl-4 col-lg-4 col-md-6"
         data-aos="fade-up"
         data-aos-delay="100">

        <div class="product-card">

            <span class="badge '.$badgeClass.'">'.$badge.'</span>

            <div class="product-img">
                <img src="'.asset('products/'.$product->image).'" alt="'.$product->name.'">
            </div>

            <div class="product-body text-center">
                <h5>'.$product->name.'</h5>

                <p class="desc">
                    '.\Illuminate\Support\Str::limit($product->description, 85).'
                </p>

                <div class="price">'.$price.'</div>

                <a href="'.route('product.description', $product->id).'"
                   class="btn view-btn">
                    View Product
                </a>
            </div>
        </div>
    </div>';
}
@endphp

{{-- ===================== SECTIONS ===================== --}}
@foreach([
    ['title'=>'Best Sellers','data'=>$bestSellers,'badge'=>'Best Seller','bg'=>'section-light',
     'desc'=>'Our most admired pieces — chosen for elegance, quality, and timeless luxury.'],
    ['title'=>'New Arrivals','data'=>$newArrivals,'badge'=>'New Arrival','bg'=>'section-dark',
     'desc'=>'Freshly curated designs that define modern luxury and refined beauty.'],
    ['title'=>'On Sale','data'=>$onSale,'badge'=>'On Sale','bg'=>'section-light',
     'desc'=>'Exclusive offers on premium collections — luxury made irresistible.'],
    ['title'=>'In Stock','data'=>$inStock,'badge'=>'In Stock','bg'=>'section-dark',
     'desc'=>'Ready-to-ship creations crafted with care and available instantly.'],
] as $section)

<section class="product-section {{ $section['bg'] }}">
    <div class="container">

        <div class="section-head text-center"
             data-aos="fade-up">
            <h2>{{ $section['title'] }}</h2>
            <p>{{ $section['desc'] }}</p>
        </div>

        <div class="row g-4">
            @foreach($section['data']->take(6) as $product)
                {!! renderProductCard($product, $section['badge']) !!}
            @endforeach
        </div>

        <div class="text-center mt-5"
             data-aos="fade-up"
             data-aos-delay="300">
            <a href="{{ url('/user/products') }}"
               class="btn btn-accent btn-lg">
                See More
            </a>
        </div>

    </div>
</section>
@endforeach

{{-- ===================== STYLES ===================== --}}
<style>
.hero-img { height: 85vh; object-fit: cover; }
.hero-caption {
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.hero-caption h1 { font-size: 3.2rem; }
.hero-caption p {
    max-width: 700px;
    font-size: 1.1rem;
    margin-bottom: 25px;
}

/* SECTIONS */
.product-section { padding: 90px 0; }
.section-light { background: #f6f6f6; color: #111; }
.section-dark { background: #000; color: #fff; }
.section-head h2 { font-size: 2.6rem; }
.section-head p {
    max-width: 720px;
    margin: 15px auto 0;
    font-size: 1.05rem;
}

/* PRODUCT CARD */
.product-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    transition: 0.4s ease;
    position: relative;
}
.section-dark .product-card {
    background: #111;
    color: #fff;
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 40px rgba(255,47,146,0.25);
}
.product-img img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    transition: 0.4s ease;
}
.product-card:hover img { transform: scale(1.07); }
.product-body { padding: 22px; }
.desc { font-size: 0.85rem; opacity: 0.75; }
.old-price { text-decoration: line-through; color: #999; margin-right: 6px; }
.new-price { font-weight: 600; color: #ff2f92; }

/* BUTTONS */
.view-btn {
    border: 1px solid #ff2f92;
    color: #ff2f92;
    padding: 6px 18px;
}
.view-btn:hover {
    background: #ff2f92;
    color: #fff;
}

/* BADGES */
.badge {
    position: absolute;
    top: 14px;
    left: 14px;
    font-size: 0.7rem;
    padding: 6px 14px;
    border-radius: 50px;
}
.badge-best { background: linear-gradient(135deg,#ff2f92,#ff7bc1); }
.badge-new { background: linear-gradient(135deg,#6a11cb,#2575fc); }
.badge-sale { background: linear-gradient(135deg,#ff512f,#dd2476); }
.badge-stock { background: linear-gradient(135deg,#11998e,#38ef7d); }
.badge-out { background: linear-gradient(135deg,#444,#000); }

/* RESPONSIVE */
@media(max-width:768px){
    .hero-img { height: 65vh; }
    .hero-caption h1 { font-size: 2.2rem; }
}
</style>

{{-- ===================== AOS JS ===================== --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 900,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80
    });
</script>

@endsection
