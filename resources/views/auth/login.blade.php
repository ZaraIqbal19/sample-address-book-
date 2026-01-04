@extends('user.layout')
@section('content')

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center"
     style="background: linear-gradient(135deg, #fff1f7, #f8f9ff);">

    <div class="row w-100 shadow-lg rounded-4 overflow-hidden"
         style="max-width: 900px; background:#ffffff;">

        <!-- Image Section -->
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9"
                 class="img-fluid h-100 w-100"
                 style="object-fit: cover;">
        </div>

        <!-- Login Form -->
        <div class="col-md-6 p-5">

            <h1 class="text-center mb-3"
                style="
                    font-family: 'Playfair Display', serif;
                    font-size: 34px;
                    font-weight: 600;
                    color: #ff2f92;
                ">
                Address Book
            </h1>

            <p class="text-center mb-4 text-muted">
                Welcome back! Login to continue
            </p>

            <!-- Errors -->
            <x-validation-errors class="mb-3" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control rounded-3"
                           value="{{ old('email') }}"
                           required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label text-muted fw-semibold">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control rounded-3"
                           required>
                </div>

                <!-- Remember -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="d-flex align-items-center">
                        <input type="checkbox" name="remember" class="me-2">
                        <span class="text-muted">Remember me</span>
                    </label>

                    <a href="{{ route('password.request') }}"
                       style="color:#ff2f92; font-size:14px;">
                        Forgot password?
                    </a>
                </div>

                <!-- Button -->
                <button type="submit"
                        class="btn w-100 text-white py-2"
                        style="
                            background:#ff2f92;
                            border-radius:30px;
                            font-weight:500;
                        ">
                    Log in
                </button>

                <!-- Register -->
                <p class="text-center mt-4 mb-0" style="font-size:14px;">
                    New here?
                    <a href="{{ route('register') }}"
                       style="color:#ff2f92; font-weight:500;">
                        Create an account
                    </a>
                </p>

            </form>
        </div>
    </div>
</div>

@endsection
