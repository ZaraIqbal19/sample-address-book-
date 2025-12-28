@extends('user.layout')
@section('content')
    <!-- About Start -->
    <div class="container-fluid bg-secondary">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7 pb-0 pb-lg-5 py-5">
                    <div class="pb-0 pb-lg-5 py-5">
                        <div class="title wow fadeInUp" data-wow-delay="0.1s">
                            <div class="title-left">
                                <h5>About Us</h5>
                                <h1>Welcome to Address Book</h1>
                            </div>
                        </div>
                        <p class="mb-4 wow fadeInUp" data-wow-delay="0.2s">
                            Address Book is your one-stop solution to explore a wide range of Cosmetics and Jewellery.
                            Discover top-quality products, brands, and personalized recommendations to enhance your style
                            and beauty.
                        </p>
                        <ul class="list-group list-group-flush mb-5 wow fadeInUp" data-wow-delay="0.3s">
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Explore top cosmetics brands.
                            </li>
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Discover exquisite jewellery collections.
                            </li>
                            <li class="list-group-item bg-dark text-body border-secondary ps-0">
                                <i class="fa fa-check-circle text-primary me-1"></i> Personalized recommendations for your style.
                            </li>
                        </ul>
                        <div class="row wow fadeInUp" data-wow-delay="0.4s">
                            <div class="col-6">
                                <a href="cosmetics.html" class="btn btn-outline-primary border-2 py-3 w-100">Explore Cosmetics</a>
                            </div>
                            <div class="col-6">
                                <a href="jewellery.html" class="btn btn-primary py-3 w-100">Explore Jewellery</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="img-fluid" src="User/img/about.png" alt="About Address Book">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Categories Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Categories</h5>
                        <h1>Our Collections</h1>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <!-- Cosmetics Category -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card bg-dark text-white border-0">
                        <img src="User/img/cosmetics.jpg" class="card-img" alt="Cosmetics">
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="card-title">Cosmetics</h3>
                            <p class="card-text">Explore top-quality cosmetics to enhance your beauty and confidence.</p>
                            <a href="cosmetics.html" class="btn btn-outline-primary border-2">View Cosmetics</a>
                        </div>
                    </div>
                </div>
                <!-- Jewellery Category -->
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="card bg-dark text-white border-0">
                        <img src="User/img/jewellery.jpg" class="card-img" alt="Jewellery">
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="card-title">Jewellery</h3>
                            <p class="card-text">Discover exquisite jewellery pieces to complement your style.</p>
                            <a href="jewellery.html" class="btn btn-outline-primary border-2">View Jewellery</a>
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
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Testimonial</h5>
                        <h1>What Our Customers Say</h1>
                    </div>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                <div class="testimonial-item text-center"
                    data-dot="<img class='img-fluid' src='User/img/testimonial-1.jpg' alt='Customer'>">
                    <p class="fs-5">Amazing range of cosmetics! Quality products and excellent customer service.</p>
                    <h5 class="text-uppercase">Sarah Williams</h5>
                    <span class="text-primary">Cosmetics Enthusiast</span>
                </div>
                <div class="testimonial-item text-center"
                    data-dot="<img class='img-fluid' src='User/img/testimonial-2.jpg' alt='Customer'>">
                    <p class="fs-5">The jewellery collection is stunning. Beautiful designs at reasonable prices.</p>
                    <h5 class="text-uppercase">Emma Johnson</h5>
                    <span class="text-primary">Jewellery Lover</span>
                </div>
                <div class="testimonial-item text-center"
                    data-dot="<img class='img-fluid' src='User/img/testimonial-3.jpg' alt='Customer'>">
                    <p class="fs-5">Highly recommended! The Address Book makes it easy to explore all products in one place.</p>
                    <h5 class="text-uppercase">Olivia Brown</h5>
                    <span class="text-primary">Satisfied Customer</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
