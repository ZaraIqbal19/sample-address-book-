<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('User/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap"
        rel="stylesheet">
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

    <!-- Custom Styles -->
    <style>
        /* Navbar brand alignment */
        .navbar-brand h2 {
            display: flex;
            align-items: center; /* vertically centers image and text */
            margin-bottom: 0;
            gap: 20px; /* more space between image and text */
        }

        .navbar-brand h2 img {
            max-height: 50px;
        }

        /* Navbar links styling */
        .navbar-nav .nav-link {
            color: hotpink !important;
            font-size: 1.2rem;
            font-weight: 600;
              color: #ff2a95ff !important;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #d31876ff !important;
            text-decoration: underline;
        }

        /* Login & Register buttons hover color */
        .btn-outline-light:hover {
            background-color: #ff2a95ff !important;
            border-color: #ff2a95ff !important;
            color: white !important;
        }

        /* Increase size of wishlist & cart icons */
        .btn-outline-light i.fa-heart,
        .btn-outline-light i.fa-shopping-cart {
            font-size: 1.5rem; /* bigger icons */
        }

        /* Optional: add spacing inside buttons */
        .btn-outline-light {
            padding: 0.5rem 0.8rem;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid px-lg-8 mt-2 ms-lg-5">
            <!-- Brand -->
            <a class="navbar-brand" href="/home">
                <h2 class="text-primary text-uppercase mt-2 ms-5">
                    <img src="{{ asset('Genie/img/Logo1.png') }}" alt="Logo">
                    Address Book
                </h2>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Links -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="/home" class="nav-item nav-link">Home</a>
                    <a href="/shop" class="nav-item nav-link">Shop</a>
                    <a href="/contact" class="nav-item nav-link">Contact</a>
                </div>

                <!-- Right Side -->
                <div class="d-flex align-items-center">
                    @auth
                        <!-- Wishlist Icon -->
                        <a href="/wishlist" class="btn btn-outline-light position-relative me-2">
                            <i class="fa fa-heart"></i>
                            @if(auth()->user()->wishlists()->count() > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ auth()->user()->wishlists()->count() }}
                                </span>
                            @endif
                        </a>

                        <!-- Cart Icon -->
                        <a href="/cart" class="btn btn-outline-light position-relative me-3">
                            <i class="fa fa-shopping-cart"></i>
                            @if(auth()->user()->carts()->count() > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ auth()->user()->carts()->count() }}
                                </span>
                            @endif
                        </a>

                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/orders">My Orders</a></li>
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="/login" class="btn btn-outline-light me-2">Login</a>
                        <a href="/register" class="btn btn-outline-light">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Content Start -->
    <div class="content-area bg-light min-vh-100 py-5">
        @yield('content')
    </div>
    <!-- Content End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer py-5">
        <div class="container text-center py-5">
            <a href="/home" class="text-decoration-none">
                <h1 class="display-4 mb-3 text-white text-uppercase mt-2">
                    <img src="{{ asset('Genie/img/Logo1.png') }}" alt="Logo" class="img-fluid me-1"
                        style="max-height:100px;">
                    Address Book
                </h1>
            </a>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://twitter.com"
                    target="_blank"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://facebook.com"
                    target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://youtube.com"
                    target="_blank"><i class="fab fa-youtube"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://linkedin.com"
                    target="_blank"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p class="mb-1">&copy; <a class="text-decoration-none text-white" href="/home">MyStore</a>, All
                Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer End -->

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
