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

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container-fluid px-lg-5">

        <!-- Brand -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <h2 class="mb-0 text-primary text-uppercase">
                <i class="fa-regular fa-face-smile me-1"></i>Address Book
            </h2>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Links -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">

                <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link">About</a>
                <a href="{{ url('/services') }}" class="nav-item nav-link">Services</a>

                <!-- Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url('') }}" class="dropdown-item">Cosmetics</a>
                        <a href="{{ url('') }}" class="dropdown-item">Jewellery</a>
                    </div>
                </div>

                <a href="{{ url('') }}" class="nav-item nav-link">Contact</a>

            </div>

    
</nav>
<!-- Navbar End -->



    <div class="content-area bg-light min-vh-100 py-0">
    @yield('content')
</div>




<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer py-5">
    <div class="container text-center py-5">

        <!-- Brand / Logo -->
        <a href="{{ url('/') }}" class="text-decoration-none">
            <h1 class="display-4 mb-3 text-white text-uppercase">
                <i class="fa-regular fa-face-smile me-1"></i>Address Book
            </h1>
        </a>

        <!-- Social Links -->
        <div class="d-flex justify-content-center mb-4">
            <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://twitter.com" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://facebook.com" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://youtube.com" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
            <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://linkedin.com" target="_blank">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>

        <!-- Copyright -->
        <p class="mb-1">&copy; <a class="text-decoration-none text-white" href="{{ url('/') }}">Address Book</a>, All Rights Reserved.</p>
        

    </div>
</div>
<!-- Footer End -->

<!-- Optional: Ensure no background image -->
<style>
.footer {
    background-image: none !important;
}
</style>


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
