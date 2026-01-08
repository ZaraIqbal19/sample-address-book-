@extends('genie.genielayout')

@section('page-name', 'Dashboard')
@section('content')

<div class="container-fluid py-5" style="background:#f7f8fc; min-height:100vh;">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11 col-md-12">

            {{-- DASHBOARD CARD --}}
            <div class="card border-0 p-5 wow fadeInUp"
                 style="background:#ffffff; border-radius:22px; box-shadow: 0 24px 55px rgba(0,0,0,0.08);">

                {{-- Accent Bar --}}
                <div style="width:60px; height:5px; background:#ff2a95; border-radius:10px; margin-bottom:24px;"></div>

                {{-- Welcome --}}
                <h1 class="fw-bold mb-2 text-uppercase" style="color:#1f1f1f;">Welcome back, {{ auth()->user()->name }}</h1>
                <hr>
                <p class="fs-5 mb-4" style="color:#6b7280;">
                    Here's an overview of your Genie platform. Manage users, products, orders, and vendors efficiently.
                </p>

                {{-- Role Info --}}
                <div class="d-inline-flex align-items-center px-4 py-2 mb-5"
                     style="background:#fff1f7; color:#ff2a95; border-radius:30px; font-weight:500; font-size:15px;">
                    {{ ucfirst(auth()->user()->role) }} Access
                </div>

                {{-- CARDS --}}
                <div class="row g-4">

                    {{-- Total Users --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card shadow-sm p-4 text-center text-pink wow fadeInUp" data-wow-delay="0.1s">
                            <h5 class="fw-bold mb-2">Total Users</h5>
                            <h2 class="fw-bold counter">{{ \App\Models\User::count() }}</h2>
                            <p class="text-muted">Registered users</p>
                            <a href="{{ route('genie.user') }}" class="btn btn-sm btn-outline-pink mt-2">Manage Users</a>
                        </div>
                    </div>

                    {{-- Total Products --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card shadow-sm p-4 text-center text-pink wow fadeInUp" data-wow-delay="0.2s">
                            <h5 class="fw-bold mb-2">Total Products</h5>
                            <h2 class="fw-bold counter">{{ \App\Models\Product::count() }}</h2>
                            <p class="text-muted">Products in the catalog</p>
                            <a href="{{ route('genie.product_info') }}" class="btn btn-sm btn-outline-pink mt-2">Manage Products</a>
                        </div>
                    </div>

                    {{-- Total Orders --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card shadow-sm p-4 text-center text-pink wow fadeInUp" data-wow-delay="0.3s">
                            <h5 class="fw-bold mb-2">Total Orders</h5>
                            <h2 class="fw-bold counter">{{ \App\Models\Order::count() ?? 0 }}</h2>
                            <p class="text-muted">Orders placed by users</p>
                            <a href="{{ route('genie.orders') }}" class="btn btn-sm btn-outline-pink mt-2">View Orders</a>
                        </div>
                    </div>

                    {{-- Total Vendors --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card shadow-sm p-4 text-center text-pink wow fadeInUp" data-wow-delay="0.4s">
                            <h5 class="fw-bold mb-2">Vendors</h5>
                            <h2 class="fw-bold counter">{{ \App\Models\Vendor::count() ?? 0 }}</h2>
                            <p class="text-muted">Active vendors supplying products</p>
                            <a href="{{ route('genie.vendorshow') }}" class="btn btn-sm btn-outline-pink mt-2">Manage Vendors</a>
                        </div>
                    </div>

                </div>

                {{-- Additional Info --}}
                <div class="mt-5 wow fadeIn" data-wow-delay="0.5s">
                    <p class="text-muted fs-6">
                        Track product performance, update best sellers, manage vendors, and efficiently handle orders—all from your Genie dashboard.
                    </p>
                </div>

            </div>

        </div>
    </div>

</div>

{{-- Styles --}}
<style>
.dashboard-card {
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background:#fff;
}
.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.12);
}

/* Buttons & Colors */
.text-pink { color:#ff2a95; }
.btn-outline-pink { border:1px solid #ff2a95; color:#ff2a95; transition:0.3s; }
.btn-outline-pink:hover { background:#ff2a95; color:#fff; }


/* Counters */
.counter { font-size:2rem; transition: all 0.6s ease; }

/* Responsive */
@media(max-width:767px){
    .dashboard-card { padding:20px; }
}
</style>

{{-- Animations --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
new WOW().init();

// Animated counters
$('.counter').each(function() {
    var $this = $(this),
        countTo = $this.text();
    $({ countNum: 0 }).animate({ countNum: countTo }, {
        duration: 1200,
        easing: 'swing',
        step: function() { $this.text(Math.floor(this.countNum)); },
        complete: function() { $this.text(this.countNum); }
    });
});
</script>

@endsection
