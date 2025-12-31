<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Address Book - Explore Cosmetics & Jewellery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Address Book for Cosmetics and Jewellery">

    <!-- Favicon -->
    <link href="{{ asset('User/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Library Stylesheets -->
    <link href="{{ asset('User/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap & Custom CSS -->
    <link href="{{ asset('User/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand ms-4 ms-lg-0">
            <h2 class="mb-0 text-primary text-uppercase"><i class="fa-regular fa-face-smile me-1"></i>Address Book</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link">About</a>
                <a href="{{ url('/services') }}" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url('/cosmetics') }}" class="dropdown-item">Cosmetics</a>
                        <a href="{{ url('/jewellery') }}" class="dropdown-item">Jewellery</a>
                    </div>
                </div>
                <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
            </div>
            <div class="d-none d-lg-flex">
                <a class="btn btn-outline-primary border-2" href="#">Download Now</a>
            </div>
        </div>
    </nav>

</div>
<!-- Header End -->


    <!-- Main Content Area with Greyish White Background -->
    <div class="content-area" style="background-color: #f5f5f5; min-height: 80vh; padding-top: 30px; padding-bottom: 30px;">
        @yield('content')
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <a href="{{ url('/') }}">
                <h1 class="display-4 mb-3 text-white text-uppercase"><i class="fa-regular fa-face-smile me-1"></i>Address Book</h1>
            </a>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i class="fab fa-x-twitter"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i class="fab fa-youtube"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p>&copy; <a class="border-bottom" href="#">Your Site Name</a>, All Rights Reserved.</p>
            <p class="mb-0">Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>. Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>.</p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-primary border-2 btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('User/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('User/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('User/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('User/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('User/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('User/js/main.js') }}"></script>
</body>

</html>
