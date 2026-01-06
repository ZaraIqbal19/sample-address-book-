<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('User/img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS (MUST COME FIRST) -->
    <link href="{{ asset('User/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Animation & Plugins -->
    <link href="{{ asset('User/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('User/css/style.css') }}" rel="stylesheet">

    <!-- Custom Inline Styles -->
    <style>
        .navbar-brand h2 {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 0;
        }

        .navbar-brand h2 img {
            max-height: 50px;
        }

        .navbar-nav .nav-link {
            font-size: 0.6rem;
            font-weight: 600;
            color: #ff2a95 !important;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #d31876 !important;
            text-decoration: underline;
        }

        .btn-outline-light:hover {
            background-color: #ff2a95 !important;
            border-color: #ff2a95 !important;
            color: #fff !important;
        }

        .btn-outline-light i {
            font-size: 1.5rem;
        }

        .content-area {
            padding-top: 100px; /* fixed navbar spacing */
        }
    </style>
</head>

<body>

<!-- Spinner -->
<div id="spinner"
     class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container-fluid px-lg-5">

        <a class="navbar-brand" href="/home">
            <h2 class="text-primary text-uppercase">
                <img src="{{ asset('Genie/img/Logo1.png') }}" alt="Logo">
                Address Book
            </h2>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="/home" class="nav-item nav-link">Home</a>
                <a href="/user/products" class="nav-item nav-link">Shop</a>
                <a href="/contact" class="nav-item nav-link">Contact</a>
            </div>

            <div class="d-flex align-items-center">
                @auth
                    <a href="/wishlist" class="btn btn-outline-light position-relative me-2">
                        <i class="fa fa-heart"></i>
                        @if(auth()->user()->wishlists()->count())
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ auth()->user()->wishlists()->count() }}
                            </span>
                        @endif
                    </a>

                    <a href="/cart" class="btn btn-outline-light position-relative me-3">
                        <i class="fa fa-shopping-cart"></i>
                        @if(auth()->user()->carts()->count())
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ auth()->user()->carts()->count() }}
                            </span>
                        @endif
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/orders">My Orders</a></li>
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
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

<!-- Content -->
<div class="content-area bg-dark min-vh-100">
    @yield('content')
</div>

<!-- Footer -->
<div class="container-fluid bg-dark text-light py-5">
    <div class="container text-center">
        <h1 class="text-uppercase text-white">
            <img src="{{ asset('Genie/img/Logo1.png') }}" style="max-height:80px;">
            Address Book
        </h1>
        <p class="mb-0">&copy; MyStore. All Rights Reserved.</p>
    </div>
</div>

<!-- JS (ORDER IS CRITICAL) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="{{ asset('User/js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugins (SAFE AFTER BOOTSTRAP) -->
<script src="{{ asset('User/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('User/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('User/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('User/lib/lightbox/js/lightbox.min.js') }}"></script>

<!-- Template JS -->
<script src="{{ asset('User/js/main.js') }}"></script>

</body>
</html>
