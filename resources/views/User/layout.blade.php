<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Address Book')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('User/img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Plugins -->
    <link href="{{ asset('User/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- ===== GLOBAL USER THEME ===== -->
    <style>
        :root {
            --pink: #ff2f92;
            --pink-glow: rgba(255, 47, 146, 0.6);
            --dark: #000;
            --dark-soft: #121212;
            --text-light: #eaeaea;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark);
            color: var(--text-light);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.5px;
        }

        a {
            text-decoration: none !important;
        }

        /* ===== SPINNER ===== */
        #spinner {
            position: fixed;
            inset: 0;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        #spinner .spinner-border {
            width: 3rem;
            height: 3rem;
            color: var(--pink);
            box-shadow: 0 0 20px var(--pink-glow);
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: #000 !important;
            padding: 0.4rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .navbar-brand h2 {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.3rem;
            color: #fff;
        }

        .navbar-brand img {
            max-height: 46px;
        }

        .navbar-nav .nav-link {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--pink) !important;
            position: relative;
            padding: 8px 14px;
        }

        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--pink);
            transition: 0.3s;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after {
            width: 60%;
        }

        /* ===== BUTTONS ===== */
        .btn-outline-pink {
            border: 1px solid var(--pink);
            color: var(--pink);
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-pink:hover {
            background: var(--pink);
            color: #fff;
            box-shadow: 0 0 15px var(--pink-glow);
        }

        /* ===== CART BADGE ===== */
        .cart-badge {
            background: var(--pink);
            font-size: 0.65rem;
            box-shadow: 0 0 10px var(--pink-glow);
        }

        /* ===== DROPDOWN ===== */
        .dropdown-menu {
            background: #111;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .dropdown-item {
            color: #fff;
            font-size: 0.85rem;
        }

        .dropdown-item:hover {
            background: var(--pink);
            color: #fff;
        }

        /* ===== CONTENT ===== */
        .content-area {
            padding-top: 100px;
            min-height: calc(100vh - 220px);
            animation: fadeUp 0.8s ease forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== FOOTER ===== */
        footer {
            background: #0a0a0a;
            padding: 60px 0;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        footer img {
            max-height: 80px;
        }

        footer p {
            font-size: 0.85rem;
            color: #aaa;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-brand h2 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

<!-- ===== SPINNER ===== -->
<div id="spinner">
    <div class="spinner-border" role="status"></div>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid px-lg-5">

        <a class="navbar-brand" href="/">
            <h2 class="text-uppercase">
                <img src="{{ asset('Genie/img/Logo1.png') }}">
                Address Book
            </h2>
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/user/products" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="/cart" class="btn btn-outline-pink position-relative">
                        <i class="fa fa-shopping-cart"></i>
                        @if(auth()->user()->carts()->count())
                            <span class="badge cart-badge position-absolute top-0 start-100 translate-middle">
                                {{ auth()->user()->carts()->count() }}
                            </span>
                        @endif
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-outline-pink dropdown-toggle text-uppercase" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/my-orders">My Orders</a></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="/login" class="btn btn-outline-pink">Login</a>
                    <a href="/register" class="btn btn-outline-pink">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- ===== PAGE CONTENT ===== -->
<div class="content-area">
    @yield('content')
</div>

<!-- ===== FOOTER ===== -->
<footer class="text-center">
    <div class="container">
        <h1 class="text-uppercase text-white">
            <img src="{{ asset('Genie/img/Logo1.png') }}">
            Address Book
        </h1>
        <p class="mt-3 mb-0">&copy; {{ date('Y') }} Address Book. All Rights Reserved.</p>
    </div>
</footer>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('User/lib/lightbox/js/lightbox.min.js') }}"></script>

<script>
    $(window).on('load', function () {
        $('#spinner').fadeOut(600);
    });

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        autoplay: true,
        autoplayTimeout: 4000,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1200: { items: 3 }
        }
    });
</script>

</body>
</html>
