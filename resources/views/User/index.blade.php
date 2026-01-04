@extends('user.layout')

@section('content')

<!-- Page Styles -->
<style>
    body {
        font-family: 'Josefin Sans', sans-serif;
        background-color: #f8f8f8;
    }

    .carousel-item {
        min-height: 100vh;
    }

    .carousel-caption {
        left: 50px;
        bottom: 50px;
        color: #fff;
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
        transition: 0.3s ease;
    }

    .card-overlay:hover {
        background: rgba(0,0,0,0.6);
    }

    .testimonial-item {
        background: #1a1a1a;
        color: #fff;
        padding: 30px;
        border-radius: 10px;
    }
    <style>
.category-card {
    transition: all 0.3s ease;
}
.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,.15);
}
</style>

</style>

<!-- Carousel -->
<div id="homepageCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1600180758895-5562cba92b87?auto=format&fit=crop&w=1600&q=80"
                 class="d-block w-100 vh-100 object-fit-cover" alt="Cosmetics">
            <div class="carousel-caption d-flex flex-column justify-content-center text-start h-100 px-5">
                <h1 class="display-2 fw-bold">Cosmetics Collection</h1>
                <p class="text-white-50 fs-4">Premium cosmetics for a flawless look.</p>
               <a href="#" class="btn btn-primary">Explore Cosmetics</a>

            </div>
        </div>

        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1562339736-b6f0f2f1d621?auto=format&fit=crop&w=1600&q=80"
                 class="d-block w-100 vh-100 object-fit-cover" alt="Jewellery">
            <div class="carousel-caption d-flex flex-column justify-content-center text-start h-100 px-5">
                <h1 class="display-2 fw-bold">Jewellery Collection</h1>
                <p class="text-white-50 fs-4">Timeless elegance for every occasion.</p>
               <a href="#" class="btn btn-primary">Explore Jewellery</a>

            </div>
        </div>

    </div>
</div>


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
                    <div class="card border-0 shadow-sm h-100 category-card">
                        <img src="{{ $category['image'] }}"
                             class="card-img-top"
                             style="height:260px; object-fit:cover;">

                        <div class="card-body text-center">
                            <h5 class="fw-semibold text-dark">
                                {{ $category['name'] }}
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<style>
.category-card {
    transition: all 0.3s ease;
}
.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,.15);
}
</style>


@endsection
