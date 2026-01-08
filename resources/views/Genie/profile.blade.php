@extends('genie.genielayout')

@section('page-name', 'Profile')
@section('content')

<div class="container-fluid py-5" style="background:#f7f8fc; min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-10">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 p-5 profile-card">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-semibold mb-1 text-uppercase" style="color:#0a0a0aff;">HELLO
                            {{ auth()->user()->name }},
                        </h2>
                        <span class="text-muted">Profile Overview</span>
                    </div>

                    <!-- EDIT PROFILE BUTTON -->
                    <button id="editProfileBtn"
                            class="btn btn-outline-pink btn-sm px-4"
                            onclick="window.location.href='/genie/profileedit'">
                        <i class="bi bi-pencil"></i> Edit Profile
                    </button>
                </div>

                <hr class="mb-4">

                <!-- PROFILE VIEW -->
                <div id="profileView">

                    <div class="info-row">
                        <div class="icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <small class="text-dark ps-2">Full Name</small>
                            <div class="fw-bold text-black text-uppercase font-big p-2">{{ auth()->user()->name }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <small class="text-dark ps-2">Email Address</small>
                            <div class="fw-bold text-black p-2">{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <span class="badge role-badge">
                            {{ ucfirst(auth()->user()->role) }} Access
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- STYLES --}}
<style>
.profile-card {
    background:#fff;
    border-radius:18px;
    box-shadow:0 15px 35px rgba(0,0,0,0.06);
}

/* Info rows */
.info-row {
    display:flex;
    align-items:center;
    gap:15px;
    padding:14px 18px;
    border-radius:12px;
    background:#f9fafb;
    margin-bottom:14px;
    transition:all .3s ease;
}

.info-row:hover {
    background:#ffffff;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
}

.info-row .icon {
    width:42px;
    height:42px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:#fff1f7;
    color:#ff4f9a;
    font-size:18px;
}

/* Role badge */
.role-badge {
    background:#fff1f7;
    color:#ff4f9a;
    padding:8px 18px;
    border-radius:30px;
    font-weight:500;
}

/* Pink Outline Button */
.btn-outline-pink {
    color:#ff4f9a;
    border:1.5px solid #ff4f9a;
    background:transparent;
    transition:all 0.3s ease;
    border-radius:30px;
}

.btn-outline-pink:hover,
.btn-outline-pink:focus {
    background:#ff4f9a;
    color:#ffffff;
    border-color:#ff4f9a;
    box-shadow:0 6px 18px rgba(255,79,154,0.35);
}

.btn-outline-pink i {
    transition:transform 0.3s ease;
}

.btn-outline-pink:hover i {
    transform:translateX(2px);
}
</style>

@endsection
