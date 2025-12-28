<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Address Book - Explore Cosmetics & Jewellery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Address Book for Cosmetics and Jewellery" name="description">

    <!-- Favicon -->
    <link href="User/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="User/lib/animate/animate.min.css" rel="stylesheet">
    <link href="User/lib/lightbox/User/css/lightbox.min.css" rel="stylesheet">
    <link href="User/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="User/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="User/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Header Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-lg-5">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h2 class="mb-0 text-primary text-uppercase"><i class="fa-regular fa-face-smile me-1"></i>Address Book</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-4 p-lg-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Services</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu m-0">
                            <a href="cosmetics.html" class="dropdown-item">Cosmetics</a>
                            <a href="jewellery.html" class="dropdown-item">Jewellery</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-none d-lg-flex">
                    <a class="btn btn-outline-primary border-2" href="#">Download Now</a>
                </div>
            </div>
        </nav>

        <!-- Carousel Start -->
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="User/img/carousel-1.jpg" alt="Cosmetics">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="title mx-5 px-5 animated slideInDown">
                            <div class="title-center">
                                <h5>Discover</h5>
                                <h1 class="display-1">Cosmetics Collection</h1>
                            </div>
                        </div>
                        <p class="fs-5 mb-5 animated slideInDown">Explore our premium cosmetics range<br>for a flawless look every day.</p>
                        <a href="cosmetics.html" class="btn btn-outline-primary border-2 py-3 px-5 animated slideInDown">Explore Cosmetics</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="User/img/carousel-2.jpg" alt="Jewellery">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="title mx-5 px-5 animated slideInDown">
                            <div class="title-center">
                                <h5>Explore</h5>
                                <h1 class="display-1">Jewellery Collection</h1>
                            </div>
                        </div>
                        <p class="fs-5 mb-5 animated slideInDown">Find exquisite jewellery pieces<br>to complement your style and elegance.</p>
                        <a href="jewellery.html" class="btn btn-outline-primary border-2 py-3 px-5 animated slideInDown">Explore Jewellery</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carousel End -->
    </div>
    <!-- Header End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <a href="index.html">
                <h1 class="display-4 mb-3 text-white text-uppercase"><i
                        class="fa-regular fa-face-smile me-1"></i>Address Book</h1>
            </a>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i
                        class="fab fa-x-twitter"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i
                        class="fab fa-youtube"></i></a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="#!"><i
                        class="fab fa-linkedin-in"></i></a>
            </div>
            <p>&copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.</p>
            <p class="mb-0">Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>. Distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>.</p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-primary border-2 btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="User/lib/wow/wow.min.js"></script>
    <script src="User/lib/easing/easing.min.js"></script>
    <script src="User/lib/waypoints/waypoints.min.js"></script>
    <script src="User/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="User/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="User/js/main.js"></script>
</body>

</html>
