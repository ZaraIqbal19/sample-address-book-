@extends('user.layout')
@section('content')

<!-- Inline CSS to match visual -->
<style>
    body {
        font-family: 'Josefin Sans', sans-serif;
        background-color: #f8f8f8;
    }
    .carousel-caption {
        left: 50px;
        bottom: 50px;
        text-align: left;
        color: white;
    }
    .carousel-caption h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 4rem;
    }
    .carousel-caption p {
        font-size: 1.2rem;
    }
    .carousel-caption .btn {
        font-size: 1rem;
        font-weight: 600;
    }
    .bg-dark-text {
        background-color: #1a1a1a !important;
        color: #fff !important;
    }
    .section-title h5 {
        color: #ff6b6b;
        font-weight: 700;
        letter-spacing: 2px;
    }
    .section-title h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }
    .card-overlay {
        background: rgba(0,0,0,0.5);
        transition: all 0.3s ease;
    }
    .card-overlay:hover {
        background: rgba(0,0,0,0.6);
    }
    .testimonial-item {
        background-color: #1a1a1a;
        color: #fff;
        padding: 30px;
        border-radius: 10px;
    }
</style>

<!-- Carousel Start -->
<div id="homepageCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1600180758895-5562cba92b87?auto=format&fit=crop&w=1400&q=80" class="d-block w-100" alt="Cosmetics Collection" style="height:500px; object-fit:cover;">
            <div class="carousel-caption">
                <h1>Cosmetics Collection</h1>
                <p>Explore our premium cosmetics range for a flawless look every day.</p>
                <a href="{{ url('/cosmetics') }}" class="btn btn-outline-primary border-2 py-2 px-4">Explore Cosmetics</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1562339736-b6f0f2f1d621?auto=format&fit=crop&w=1400&q=80" class="d-block w-100" alt="Jewellery Collection" style="height:500px; object-fit:cover;">
            <div class="carousel-caption">
                <h1>Jewellery Collection</h1>
                <p>Find exquisite jewellery pieces to complement your style and elegance.</p>
                <a href="{{ url('/jewellery') }}" class="btn btn-outline-primary border-2 py-2 px-4">Explore Jewellery</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1600180758895-5562cba92b87?auto=format&fit=crop&w=1400&q=80" class="d-block w-100" alt="New Arrivals" style="height:500px; object-fit:cover;">
            <div class="carousel-caption">
                <h1>New Arrivals</h1>
                <p>Discover the latest additions to our cosmetics and jewellery collection.</p>
                <a href="{{ url('/products') }}" class="btn btn-outline-primary border-2 py-2 px-4">Shop Now</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homepageCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homepageCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>
<!-- Carousel End -->

<!-- About Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <div class="section-title mb-4">
                    <h5>About Us</h5>
                    <h1>Welcome to Address Book</h1>
                </div>
                <p>Address Book is your one-stop solution to explore a wide range of Cosmetics and Jewellery.
                    Discover top-quality products, brands, and personalized recommendations to enhance your style
                    and beauty.</p>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item bg-dark-text border-secondary ps-0"><i class="fa fa-check-circle text-primary me-2"></i> Explore top cosmetics brands.</li>
                    <li class="list-group-item bg-dark-text border-secondary ps-0"><i class="fa fa-check-circle text-primary me-2"></i> Discover exquisite jewellery collections.</li>
                    <li class="list-group-item bg-dark-text border-secondary ps-0"><i class="fa fa-check-circle text-primary me-2"></i> Personalized recommendations for your style.</li>
                </ul>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ url('/cosmetics') }}" class="btn btn-outline-primary py-2 w-100">Explore Cosmetics</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ url('/jewellery') }}" class="btn btn-primary py-2 w-100">Explore Jewellery</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <img src="https://images.unsplash.com/photo-1580910051073-223d43e5cf85?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded" alt="About Image">
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Categories Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="section-title">
                <h5>Categories</h5>
                <h1>Our Collections</h1>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0">
                    <img src="https://images.unsplash.com/photo-1592878849120-6b31c9cf6591?auto=format&fit=crop&w=700&q=80" class="card-img" alt="Cosmetics">
                    <div class="card-img-overlay card-overlay d-flex flex-column justify-content-end">
                        <h3>Cosmetics</h3>
                        <p>Explore top-quality cosmetics to enhance your beauty and confidence.</p>
                        <a href="{{ url('/cosmetics') }}" class="btn btn-outline-primary border-2">View Cosmetics</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0">
                    <img src="https://images.unsplash.com/photo-1591015403872-2f8dc1e429b4?auto=format&fit=crop&w=700&q=80" class="card-img" alt="Jewellery">
                    <div class="card-img-overlay card-overlay d-flex flex-column justify-content-end">
                        <h3>Jewellery</h3>
                        <p>Discover exquisite jewellery pieces to complement your style.</p>
                        <a href="{{ url('/jewellery') }}" class="btn btn-outline-primary border-2">View Jewellery</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Categories End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5 bg-secondary">
    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="section-title">
                <h5>Testimonial</h5>
                <h1>What Our Customers Say</h1>
            </div>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <div class="testimonial-item text-center">
                <p>Amazing range of cosmetics! Quality products and excellent customer service.</p>
                <h5 class="text-uppercase">Sarah Williams</h5>
                <span class="text-primary">Cosmetics Enthusiast</span>
            </div>
            <div class="testimonial-item text-center">
                <p>The jewellery collection is stunning. Beautiful designs at reasonable prices.</p>
                <h5 class="text-uppercase">Emma Johnson</h5>
                <span class="text-primary">Jewellery Lover</span>
            </div>
            <div class="testimonial-item text-center">
                <p>Highly recommended! The Address Book makes it easy to explore all products in one place.</p>
                <h5 class="text-uppercase">Olivia Brown</h5>
                <span class="text-primary">Satisfied Customer</span>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

@endsection
